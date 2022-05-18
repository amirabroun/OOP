<?php

namespace App\Helpers;

class ApiResponse
{
    public int $status;
    public string $title;
    public string $message;
    public array $data;
    public string $pagination;

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

    /**
     * @param string $title
     * @param string $text
     * @param string $type
     * @param int $reload
     *
     * @return never
     */
    public function sweetAlert()
    {
        responseJson([
            'status' => $this->status,
            'confirmButtonText' => $this->confirmButtonText ?? 'متوجه شدم!',
            'message' => [
                'title' => $this->title,
                'text' =>  $this->message,
                'type' => ($this->status === 200) ? 'success' : 'error',
            ]
        ]);
    }
}
