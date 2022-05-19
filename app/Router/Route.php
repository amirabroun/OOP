<?php

namespace App\Router;

class Route
{
    private static $resources = '/resources/Views/';

    public static function get($route, $path)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (strpos($path, 'resources')) {
                self::route($route, $path);
            }

            self::route($route, self::$resources . preparePath($path));
        }
    }

    public static function post($route, array|string|null $actionTo = null)
    {
        if (!isset($actionTo)) {
            return (new Router($route));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && checkRoute($route)) {
            $router = (new Router)->findAction($actionTo);

            $controller = $router->controller;
            $function = $router->function;
            $request = $router->request;

            if (isEmpty($request)) {
                (new $controller)->$function();
            }

            (new $controller)->$function(new $request);
        }
    }

    public static function put($route, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::route($route, $path);
        }
    }

    public static function patch($route, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            self::route($route, $path);
        }
    }

    public static function delete($route, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::route($route, $path);
        }
    }

    public static function any($route, $path)
    {
        self::route($route, $path);
    }

    private static function route($route, $path)
    {
        $ROOT = $_SERVER['DOCUMENT_ROOT'];

        if ($route == "/404") {
            include_once("$ROOT/$path");
            exit();
        }

        $route_parts = explode('/', $route);
        $request_url_parts = explode('/', strtok(rtrim(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL), '/'), '?'));
        array_shift($route_parts);
        array_shift($request_url_parts);

        if ($route_parts[0] == '' && count($request_url_parts) == 0) {
            include_once("$ROOT/$path");
            exit();
        }

        if (count($route_parts) != count($request_url_parts)) {
            return;
        }

        $parameters = [];

        for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
            $route_part = $route_parts[$__i__];

            if (preg_match("/^[$]/", $route_part)) {
                $route_part = ltrim($route_part, '$');
                array_push($parameters, $request_url_parts[$__i__]);
                $$route_part = $request_url_parts[$__i__];
            } else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
                return;
            }
        }

        include_once("$ROOT/$path");
        exit();
    }
}
