<?php

namespace Requests;

class LoginRequest extends Request
{
    protected $rules = [
        'username' => 'required',
        'password' => 'required|password'
    ];

    public function validate()
    {
        return $this->validateRequest($this->rules, 'post');
    }
}
