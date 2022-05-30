<?php

namespace App\Router;

class Route
{
    private static $resources = '/resources/Views/';

    public static function get(string $uri, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') return;

        $routeSite = explode('/', trim($uri, '/'));
        $routeUri = explode('/', uri());

        if (count($routeSite) !== count($routeUri)) return;

        foreach ($routeSite as $key => $partRoute) {
            if ($partRoute === $routeUri[$key]) continue;
            if (!isParamRouteSection($partRoute)) return;

            $var = trim($partRoute, '{}');
            $$var = ($routeUri[$key]);
        }

        strpos($path, 'resources')
            ? include_once($_SERVER['DOCUMENT_ROOT'] . $path)
            : include_once($_SERVER['DOCUMENT_ROOT'] . self::$resources . preparePath($path));
    }

    public static function post(string $uri, array|string|null $action = null)
    {
        return checkPostUri($uri)
            ? new Router($uri, $action)
            : new Router;
    }

    // create: put, patch, delete, any
}
