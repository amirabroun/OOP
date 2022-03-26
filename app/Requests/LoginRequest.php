<?php

namespace App\Requests;

class LoginRequest extends Request
{
    protected array $rules = [
        // 'username' => 'required',
        // 'password' => 'required|password'
    ];

    public function validate()
    {
        return $this->validateRequest($this->rules, 'post');
    }
}
