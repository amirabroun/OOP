<?php

namespace Requests;

class LoginRequest extends Request
{
    protected $rules = [
        'username' => 'require',
        'password' => 'require'
    ];

    public function validate()
    {
    }
}
