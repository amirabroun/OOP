<?php

if (($_SERVER['REQUEST_URI'] != "/") and preg_match('{/$}', $_SERVER['REQUEST_URI']))
    redirect(preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));

function POST($key = 'all-$_POST')
{
    if ($key === 'all-$_POST') {
        return $_POST;
    }

    return $_POST[$key] ?? null;
}

function GET($key = 'all-$_GET')
{
    if ($key === 'all-$_GET') {
        return $_GET;
    }

    return $_GET[$key] ?? null;
}

function REQUEST($key = 'all-$_REQUEST')
{
    if ($key === 'all-$_REQUEST') {
        return $_REQUEST;
    }

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
    return $_SERVER['REQUEST_SCHEME'] . '://' . domain('public') . '/' . ltrim($path, '/');
}

function adminBaseUrl()
{
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'];
}

function pageName()
{
    return ltrim(str_replace('.php', '', $_SERVER['SCRIPT_NAME']), '/');
}

function uri()
{
    return trim($_SERVER['REQUEST_URI'], '/');
}

function checkAction($action)
{
    if (!(POST("action") && POST("action") === $action)) {
        return false;
    }

    return true;
}

function checkRoute($route)
{
    $routeParts = explode('/', $route);
    $uriParts = explode('/', uri());

    if (count($routeParts) !== count($uriParts)) return false;

    foreach ($routeParts as $key => $partRoute) {
        if ($partRoute !== $uriParts[$key] && !isParamRouteSection($partRoute)) return false;
    }

    return true;
}

function checkPostRoute(string $route)
{
    return $_SERVER['REQUEST_METHOD'] !== 'POST' || !checkRoute($route) ? false : true;
}

function checkGetRoute(string $route)
{
    return $_SERVER['REQUEST_METHOD'] !== 'GET' || !checkRoute($route) ? false : true;
}

function getAction()
{
    dd(POST("action"));
}

function preparePath(string $path): string
{
    return str_replace('.', '/', $path) . '.php';
}

function set_csrf()
{
    if (!isset($_SESSION["csrf"])) {
        $_SESSION["csrf"] = bin2hex(random_bytes(50));
    }
    echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid()
{
    if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
        return false;
    }
    if ($_SESSION['csrf'] != $_POST['csrf']) {
        return false;
    }
    return true;
}
