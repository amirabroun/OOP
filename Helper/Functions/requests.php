<?php


use Config\Config;


function POST($key)
{
    return $_POST[$key] ?? null;
}

function GET($key)
{
    return $_GET[$key] ?? null;
}

function REQUEST($key)
{
    return $_REQUEST[$key] ?? null;
}

function back($url = '/')
{
    redirect($_SERVER['HTTP_REFERER'] ?? $url);
}

function originBaseUrl()
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
}

function publicBaseUrl($path = '')
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . Config::PUBLIC_DOMAIN . '/' . ltrim($path, '/');
}

function adminBaseUrl()
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
}

function pageName()
{
    return str_replace(['/', '.php'], '', $_SERVER['SCRIPT_NAME']);
}
