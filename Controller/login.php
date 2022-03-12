<?php

namespace Controllers;

use Helper\Helper;
use Models\Admin;

class LoginController extends Controller
{
    public function adminLogin()
    {
        if (!$admin_login = (new Admin())->doLogin(POST('username'), POST('password'))) {
            Helper::responseJson([
                'data' => '',
                'status' => 201,
                'message' => [
                    'title' => 'ورود ناموفق',
                    'text' => 'اطلاعات وارد شده نامعتبر است!',
                    'type' => 'error'
                ]
            ]);
        }

        if (!recaptchaVerify(parent::SECRET_KEY, POST('grecaptcha'))) {
            responseJson([
                'data' => '',
                'status' => 201,
                'message' => [
                    'title' => 'ورود ناموفق',
                    'text' => 'لطفا ثابت کنید که ربات نیستید!',
                    'type' => 'error'
                ]
            ]);
        }

        $_SESSION['_admin_log_'] = [
            'id' => $admin_login->id,
            'first_name' => $admin_login,
            'last_name' => $admin_login->last_name,
            'full_name' => "{$admin_login->first_name} {$admin_login->last_name}",
        ];

        responseJson([
            'data' => '',
            'status' => 200,
            'message' => [
                'title' => $_SESSION['_admin_log_']['full_name'] . ' عزیز',
                'text' => 'شما با موفقیت وارد شدید!',
                'type' => 'success'
            ]
        ]);
    }
}
