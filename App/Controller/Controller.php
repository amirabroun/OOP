<?php

namespace App\Controllers;

use App\Config\Config;

class Controller
{
    public function recaptchaVerify($grecaptchaToken)
    {
        return recaptchaVerify(Config::SECRET_KEY, $grecaptchaToken);
    }
}
