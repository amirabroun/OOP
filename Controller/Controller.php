<?php

namespace Controllers;

use Config\Config;

class Controller
{
    public static function successAdminLogin($admin)
    {
        $_SESSION['_admin_log_'] = [
            'id' => $admin->id,
            'first_name' => $admin,
            'last_name' => $admin->last_name,
            'full_name' => "{$admin->first_name} {$admin->last_name}",
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
    
    public function recaptchaVerify($token)
    {
        if (!recaptchaVerify(Config::SECRET_KEY, $token)) {
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
    }
}
