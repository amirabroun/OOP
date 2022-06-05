<?php

namespace App\Helpers;

class Requests
{
    public function route($route)
    {
        return uri();
    }
}
