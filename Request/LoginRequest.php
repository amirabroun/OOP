<?php

namespace Requests;

class LoginRequest extends Request
{
    protected $rules = [
        'username' => 'required|number',
        'password' => 'required|password'
    ];

    public function validate()
    {
        // dd(validator($this->rules));
        if (!$errors = $this->isNotEmptySortErrors(validator($this->rules))) {
            return $this->post;
        }

        responseJson([
            'message' => [
                'title' => 'لطفا خطاهای زیر را برطرف کنید!',
                'text' => translate($errors, true),
                'type' => 'error'
            ]
        ]);
    }
}
