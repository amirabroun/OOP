<?php

namespace App\Requests;

class LoginRequest extends Request
{
    protected array $rules = [
        'username' => 'required',
        'password' => 'required|password'
    ];

    public function validate(array $rules = null, string $returnValue = 'post')
    {
        if (isNotEmpty($rules))
            return $this->validateRequest($rules, $returnValue);

        return $this->validateRequest($this->rules, $returnValue);
    }
}