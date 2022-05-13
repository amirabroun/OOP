<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class ApiResponse
{
    const statuses = [
        'success' => 'success',
        'warning' => 'warning',
        'fail' => 'fail',
        'denied' => 'denied',
        'error' => 'error',
        'expire' => 'expire',
    ];

    const HTTP_STATUS_CODE = [
        'success' => 200,
        'bad_request' => 400,
        'unauthorized' => 401,
        'forbidden' => 403,
        'not_found' => 404,
        'conflict' => 409,
        'unprocessable_entity' => 422,
        'serverError' => 500,
    ];

    private $status;
    private $httpStatus;
    private $message;
    private $data;
    private $pagination;
    private $shortDescription;
    private $tag;
    private $parametersArray;

    function __construct($data = [])
    {
        $this->httpStatus = $data['httpStatus'] ?? self::HTTP_STATUS_CODE['success'];
        $this->data = $data['data'] ?? [];
        $this->pagination = $data['pagination'] ?? null;
        $this->shortDescription = $data['shortDescription'] ?? [];
        $this->tag = $data['tag'] ?? '';
        $this->status = $data['status'] ?? self::statuses['fail'];
    }

    /**
     * @return JsonResponse
     */
    public function json($httpStatus = null)
    {

        $data = [
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'pagination' => $this->getPagination(),
            'data' => $this->getData(),
            'tag' => $this->getTag()
        ];

        if (config('app.debug')) {
            $data['shortDescription'] = $this->getShortDescription();
        }

        return response()->json($data, $httpStatus ?? $this->httpStatus, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if ($this->status) {
            return self::statuses[$this->status] ?? $this->status;
        }
        return null;
    }

    /**
     * @param mixed $status
     * @param int $httpStatus
     */
    public function setStatus($status, $httpStatus = self::HTTP_STATUS_CODE['success'])
    {
        $this->status = strtolower($status);
        if ($httpStatus) {
            $this->setHttpStatus($httpStatus);
        }
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return trans($this->message, $this->parametersArray);
    }

    /**
     * @return null
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @return mixed
     */
    public function getData($index = null)
    {
        return $index == null ? $this->data : $this->data[$index] ?? null;
    }

    /**
     * @param $index
     * @param null $value
     */
    public function setData($index, $value = null)
    {
        if (is_array($index)) {
            array_push($this->data, $index);
        } else if (is_object($value) && $value instanceof LengthAwarePaginator) {
            $this->pagination = PaginationHelper::getPaginationInfo($value);
            $this->data[$index] = PaginationHelper::getData($value);
        } else {
            $this->data[$index] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        $segments = Request::segments();
        $implode = implode("-", $segments);
        return trim($implode);
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param mixed $status
     */
    public function setHttpStatus($status)
    {
        $this->httpStatus = intval($status);
    }

    /**
     * @param $object
     * @param $description
     * @param array|null $parametersArray
     */
    public function setShortDescription($object, $description, $parametersArray = [])
    {
        $explodedMessage = explode(":", $description);
        $message = $explodedMessage[0];
        if (isset($explodedMessage[1])) {
            $message = $explodedMessage[1];
        }
        $this->setMessage($message);
        $this->parametersArray = $parametersArray;

        $index = get_class($object);
        $this->shortDescription[$index] = $description;
    }

    /**
     * @param mixed $message
     */
    private function setMessage($message)
    {
        $this->message = trim($message);
    }
}
