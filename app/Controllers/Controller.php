<?php

namespace App\Controllers;

use App\Config\Config;

class Controller
{
    public static function recaptchaVerify($grecaptchaToken)
    {
        return recaptchaVerify(secretKey('secret_recaptcha_key'), $grecaptchaToken);
    }
}