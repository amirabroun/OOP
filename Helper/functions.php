<?php

namespace Helper;

use Config\Config;
use Functions\HelperValidator;
use Functions\HelperFunction;
use Functions\HelperRequest;

class Helper extends Config
{
    use HelperFunction, HelperRequest, HelperValidator;

    public function FunctionName()
    {
        // $a = new HelperRequest();
       $this->assets();
    }

}
// die();

// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
//     $path = '../';
// }

// require_once @$path . 'functions/requests.php';

// require_once @$path . 'functions/others.php';
// require_once @$path . 'functions/validations.php';
