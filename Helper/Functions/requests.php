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

function fail($code = 404)
{
    http_response_code($code);
    exit();
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
    return ltrim(str_replace('.php', '', $_SERVER['SCRIPT_NAME']), '/');
}

function checkAction($action)
{
    if (!(POST("action") && POST("action") === $action)) {
        return false;
    }

    return true;
}

function getAction()
{
    dd(POST("action"));
}
