<?php

namespace Requests;

class Request
{
    public $post;
    public $get;
    public $request;

    /*
     * required
     * number
     * mobile
     * password
     * persianChar
    */
    protected $rules = [];

    public function __construct()
    {
        $this->post = (object)POST();
        $this->get = (object)GET();
        $this->request = (object)REQUEST();
    }

    public function isNotEmptySortErrors($data)
    {
        if (isEmpty($data))
            return false;

            dd(1);
        $errors = [];
        $data = $data['errors'];
        foreach ($data as $key => $value) {
            $errors[$key] = $data[$key][0]['rule'];
        }

        return $errors;
    }
}
