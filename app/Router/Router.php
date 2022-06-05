<?php

namespace App\Router;

use ReflectionFunction;
use ReflectionMethod;

class Router
{
    public object|string|null $controller;
    public object|string|null $function;
    public array|null $request;

    public function __construct(private $route = null, $action = null)
    {
        if (is_callable($action)) {
            if ($this->request = $this->findParamFunction($action)) {
                call_user_func_array($action, $this->request);
                exit;
            }

            call_user_func($action);
            exit;
        }

        if ($action) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->includePath($action);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->findAction($action)->run();
            }
        }
    }

    public function run()
    {
        $controller = $this->controller;
        $function = $this->function;
        $request = $this->request;

        if ($request) {
            call_user_func_array([new $controller, $function], $request);
        }

        (new $controller)->$function();
    }

    public function findAction($action)
    {
        $action = $this->findMethodController($action);
        $this->controller = $action['controller'];
        $this->function = $action['function'];
        $this->request = $this->findParamFunction($this->function);

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

        includePath()->view($path);
    }

    public function findMethodController(array|string $action)
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

    private function findParamFunction($function)
    {
        if (isset($this->controller)) {
            $method = new ReflectionMethod($this->controller, $function);
        } else {
            $method = new ReflectionFunction($function);
        }

        $parameters = $method->getParameters();

        if (isEmpty($parameters)) {
            return null;
        }

        $types = $this->getParamType($parameters);

        $paramFunction = $this->setRequestIfExist($types);

        $paramFunction = $this->getUriData($types, $paramFunction);

        return $paramFunction;
    }

    private function getParamType($parameters)
    {
        if (isEmpty($parameters)) {
            return null;
        }

        $types = [];
        foreach ($parameters as $parameter) {
            $types[] = (string)$parameter->getType();
        }

        return $types;
    }

    private function setRequestIfExist(&$types, $paramFunction = null)
    {
        if (str_contains($types[0], 'App\\Requests\\')) {
            $request = $types[0];
            $paramFunction[] = new $request;
            array_shift($types);
        }

        return $paramFunction;
    }

    private function getUriData($types, $paramFunction = null)
    {
        $route = explode('/', $this->route);
        $uri = explode('/', uri());

        $parameterRoute = [];
        foreach ($route as $key => $partRoute) {
            if (isParamRouteSection($partRoute)) {
                $parameterRoute[] = $uri[$key];
            }
        }

        foreach ($parameterRoute as $key => $partRoute) {
            if (!isEmpty($types[$key])) {
                $type = $types[$key];
                settype($partRoute, $type);
            }

            $paramFunction[] = $partRoute;
        }

        return $paramFunction;
    }

    public function controller($controller, $function = null)
    {
        if (isEmpty($this->route)) {
            return $this;
        }

        $this->controller = new $controller();
        if ($function) {
            $this->function($function);
        }

        return $this;
    }

    public function function($function)
    {
        if (isEmpty($this->route)) {
            return $this;
        }

        $this->request = $this->findParamFunction($this->function = $function);
        $this->run();
    }
}
