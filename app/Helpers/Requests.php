<?php

namespace App\Helpers;

class Requests
{
    public function __construct(private $action = null)
    {
    }

    public function route($route)
    {
        ($this->action)($route);
    }

    public function resource($path)
    {
        ($this->action)('/resources' . '/' . preparePath($path));
    }

    public function view($path)
    {
        ($this->action)('/resources/Views/' . preparePath($path));
    }
}
