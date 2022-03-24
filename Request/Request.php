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
     * 
     */
    protected $rules = [];

    public function __construct()
    {
        $this->post = (object)POST();
        $this->get = (object)GET();
        $this->request = (object)REQUEST();
    }

    public function validateRequest($rules, $returnValue = null)
    {
        if (!isEmpty($errors = validator($rules)))
            sweetAlert(sweetAlertValidatorErrorHandling($errors), 'لطفا خطاهای زیر را برطرف کنید!', 'error');

        if ($returnValue == 'post')
            return $this->post;
        if ($returnValue == 'get')
            return $this->get;
        return $this->request;
    }
}
