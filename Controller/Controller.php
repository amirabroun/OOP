<?php

namespace Controllers;

use Config\Config;

class Controller
{
    public function recaptchaVerify($grecaptchaToken)
    {
        return recaptchaVerify(Config::SECRET_KEY, $grecaptchaToken);
    }
}
