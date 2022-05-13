<?php

namespace App\Router;

class Route
{

    private static $resources = '/resources/Views/';

    public static function get($route, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::route($route, self::$resources . self::includePath($path));
        }
    }

    public static function post($route, $path)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::route($route, $path);
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

    public static function route($route, $path)
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

    public static function out($text)
    {
        echo htmlspecialchars($text);
    }

    public static function set_csrf()
    {
        if (!isset($_SESSION["csrf"])) {
            $_SESSION["csrf"] = bin2hex(random_bytes(50));
        }
        echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
    }

    public static function is_csrf_valid()
    {
        if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
            return false;
        }
        if ($_SESSION['csrf'] != $_POST['csrf']) {
            return false;
        }
        return true;
    }

    public static function includePath(string $path): string
    {
        return str_replace('.', '/', $path) . '.php';
    }
}
