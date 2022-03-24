<?php

namespace Controllers;

use Config\Config;
use Models\Admin;
use Requests\LoginRequest;

class LoginController extends Controller
{
    public function adminLogin(LoginRequest $request)
    {
        $admin = $request->validate();
        dd($admin);
        $this->recaptchaVerify($admin->grecaptcha);
        
        $this->successAdminLogin($this->Login($admin->username, $admin->password));
    }

    public function Login($username, $password)
    {
        if (!$admin = Admin::doLogin($username, $password)) {
            responseJson([
                'data' => '',
                'status' => 201,
                'message' => [
                    'title' => 'ورود ناموفق',
                    'text' => 'اطلاعات وارد شده نامعتبر است!',
                    'type' => 'error'
                ]
            ]);
        }

        return $admin;
    }
}
