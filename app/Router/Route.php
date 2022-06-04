<?php

namespace App\Router;

class Route
{
    public static function get(string $route, array|string|null $action = null)
    {
        $route = trim($route, '/');

        return checkGetRoute($route) ? new Router($route, $action) : new Router;
    }

    public static function post(string $route, array|string|null $action = null)
    {
        $route = trim($route, '/');

        return checkPostRoute($route) ? new Router($route, $action) : new Router;
    }

    // create: put, patch, delete, any
}
