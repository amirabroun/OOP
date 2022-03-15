<?php

namespace Helper\Functions;

use Config\Config;
use Helper\Helper;

class Request
{
    public static function POST($key)
    {
        return $_POST[$key] ?? null;
    }

    public static function GET($key)
    {
        return $_GET[$key] ?? null;
    }

    public static function REQUEST($key)
    {
        return $_REQUEST[$key] ?? null;
    }

    public static function back($url = '/')
    {
        Helper::redirect($_SERVER['HTTP_REFERER'] ?? $url);
    }

    public static function originBaseUrl()
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
    }

    public static function publicBaseUrl($path = '')
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . Config::PUBLIC_DOMAIN . '/' . ltrim($path, '/');
    }

    public static function adminBaseUrl()
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
    }

    public static function pageName()
    {
        return str_replace(['/', '.php'], '', $_SERVER['SCRIPT_NAME']);
    }
}
