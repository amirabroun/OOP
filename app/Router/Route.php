<?php

namespace App\Router;

class Route
{
    public static function get(string $route, $action = null)
    {
        if (!checkGetRoute($route = trim($route, '/'))) {
            return new Router;
        }

        return new Router($route, $action);
    }

    public static function post(string $route, $action = null)
    {
        if (!checkPostRoute($route = trim($route, '/'))) {
            return new Router;
        }

        return new Router($route, $action);
    }

    // create: put, patch, delete, any
}
