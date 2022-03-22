<?php

namespace Requests;

class Request
{
    public $post;
    public $get;
    public $request;

    protected $rules = [];

    public function __construct()
    {
        $this->post = (object)POST();
        $this->get = (object)GET();
        $this->request = (object)REQUEST();
    }
}
