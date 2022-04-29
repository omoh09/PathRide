<?php
namespace App\Http;

use App\Http\Middlewares\WebMiddleware;

class Kernal
{
    protected $routeMiddleWares = [
        'web' => "App\Http\Middlewares\WebMiddleware",
    ];

    public function getMiddleWareClass($middlewareName) : String
    {
        return $this->routeMiddleWares[$middlewareName];
    }
}