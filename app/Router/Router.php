<?php

namespace App\Router;

use App\Provider\RouteServiceProvider;

class Router extends RouteServiceProvider
{
    public $controller;
    public $function;
    public $requestMethod;

    public function __construct($requestMethod, private $route, private $action = null)
    {
        $this->requestMethod = strtoupper($requestMethod);

        $this->setRouterToServiceProvider();
    }

    public function controller($controller)
    {
        $this->controller = new $controller();

        $this->setRouterToServiceProvider();

        return $this;
    }

    public function function($function)
    {
        $this->function = $function;

        $this->setRouterToServiceProvider();

        return $this;
    }

    private function setRouterToServiceProvider()
    {
        parent::$routes[$this->requestMethod][$this->route] = $this;
    }
}
