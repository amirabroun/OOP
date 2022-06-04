<?php

namespace App\Router;

use ReflectionMethod;

class Router
{
    public object|string|null $controller;
    public object|string|null $function;
    public object|string|null $request;

    private static $resources = '/resources/Views/';

    public function __construct(private $route = null, $actionTo = null)
    {
        if ($actionTo) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET')
                $this->includePath($actionTo);

            if ($_SERVER['REQUEST_METHOD'] === 'POST')
                $this->findAction($actionTo)->run();
        }
    }

    public function run()
    {
        $controller = $this->controller;
        $function = $this->function;
        $request = $this->request;

        isNotEmpty($request)
            ? (new $controller)->$function(new $request)
            : (new $controller)->$function();
    }

    public function findAction($action)
    {
        $action = $this->findSpecialMethodController($action);
        $this->controller = $action['controller'];
        $this->function = $action['function'];
        $this->request = $this->findSpecialRequest($this->function);

        return $this;
    }

    public function includePath($path)
    {
        $route = explode('/', $this->route);
        $routeUri = explode('/', uri());

        foreach ($route as $key => $partRoute) {
            if (!isParamRouteSection($partRoute)) continue;

            $var = trim($partRoute, '{}');
            $$var = ($routeUri[$key]);
        }

        strpos($path, 'resources')
            ? require($_SERVER['DOCUMENT_ROOT'] . $path)
            : require($_SERVER['DOCUMENT_ROOT'] . self::$resources . preparePath($path));
    }

    public function findSpecialMethodController(array|string $action)
    {
        if (is_string($action)) {
            $controller = "App\\Controllers\\" . substr($action, 0, strpos($action, "@"));
            $function = substr($action, strpos($action, "@") + 1);
        } else {
            $controller = $action[0];
            $function = $action[1];
        }

        return [
            'controller' => $controller,
            'function' => $function,
        ];
    }

    public function findSpecialRequest($function)
    {
        $classMethod = new ReflectionMethod($this->controller, $function);
        $parameters = $classMethod->getParameters();

        return $this->request = isset($parameters[0]) && strpos($parameters[0], 'App\\Requests\\')
            ? (string)$parameters[0]->getType()
            : null;
    }

    public function controller($controller, $function = null)
    {
        if (isEmpty($this->route)) return $this;

        $this->controller = new $controller();
        if ($function) $this->function($function);

        return $this;
    }

    public function function($function)
    {
        if (isEmpty($this->route)) return $this;

        $this->request = $this->findSpecialRequest($this->function = $function);

        $this->run();
    }
}
