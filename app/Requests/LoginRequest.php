<?php

namespace App\Requests;

class LoginRequest extends Request
{
    protected array $rules = [
        'username' => 'required',
        'password' => 'required|password'
    ];

    public function validated(array $rules = null, string $returnValue = 'post')
    {
        if (isNotEmpty($rules))
            return $this->validate($rules, $returnValue);

        return $this->validate($this->rules, $returnValue);
    }
}
