<?php

namespace App\Requests;

class Request
{
    public object $post;
    public object $get;
    public object $request;

    /**
     * @var array required
     * @var array number
     * @var array mobile
     * @var array password
     * @var array persianChar
     */
    protected array $rules = [];

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

        if ($returnValue == 'post') {
            return $this->post;
        }
        if ($returnValue == 'get') {
            return $this->get;
        }
        return $this->request;
    }
}
