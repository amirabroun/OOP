<?php

namespace App\Helpers;

class ApiResponse
{
    private array $status;
    private array $message;
    private array $data;
    private array $pagination;

    /**
     * @return json
     */
    public function json()
    {
        $data = [
            'status' => $this->getStatus(),
            'message' => $this->getMessage(),
            'pagination' => $this->getPagination(),
            'data' => $this->getData(),
        ];

        return json_encode($data);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status ?? null;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message ?? null;
    }

    /**
     * @return null
     */
    public function getPagination()
    {
        return $this->pagination ?? null;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data ?? null;
    }

    /**
     * @param $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @param $index
     * @param null $value
     */
    public function setData($index, $value = null)
    {
        if (is_array($index)) {
            array_push($this->data, $index);
        } else if (is_object($value)) {
            $this->pagination = $value;
            $this->data[$index] = $value;
        } else {
            $this->data[$index] = $value;
        }
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = intval($status);
    }

    /**
     * @param mixed $message
     */
    private function setMessage($message)
    {
        $this->message = trim($message);
    }

    /**
     * @param $object
     * @param $description
     * @param array|null $parametersArray
     */
    public function setShortDescription($object, $description)
    {
        $explodedMessage = explode(":", $description);
        $message = $explodedMessage[0];
        if (isset($explodedMessage[1])) {
            $message = $explodedMessage[1];
        }
        $this->setMessage($message);

        $index = get_class($object);
        $this->message[$index] = $description;
    }
}
