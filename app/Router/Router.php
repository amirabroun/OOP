<?php

namespace App\Router;

use ReflectionMethod;

class Router
{
    public object|string|null $controller;
    public object|string|null $function;
    public object|string|null $request;
    private $route;


    public function __construct($route = null)
    {
        $this->route = $route;

        return $this;
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

    public function findAction($action)
    {
        $action = $this->findSpecialMethodController($action);
        $this->controller = $action['controller'];
        $this->function = $action['function'];
        $this->request = $this->findSpecialRequest($this->function);

        return $this;
    }

    public function findSpecialRequest($function)
    {
        $classMethod = new ReflectionMethod($this->controller, $function);
        $parameters = $classMethod->getParameters();

        if (!isset($parameters[0])) {
            return $this->request = null;
        }

        return $this->request = (string)$parameters[0]->getType();
    }

    public function controller($controller, $function = null)
    {
        $this->controller = new $controller();

        if ($function) {
            $this->function($function);
        }

        return $this;
    }

    public function function($method)
    {
        $request = $this->findSpecialRequest($method);

        if (checkRoute($this->route)) {
            $this->controller->$method(new $request ?? null);
        }

        return $this;
    }
}
