<?php

namespace App\Http\Middlewares;

use App\Http\Middlewares\Middleware;

class WebMiddleware extends Middleware
{
    public function next($request, $next = true)
    {
        return $next;
    }
}