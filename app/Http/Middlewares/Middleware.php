<?php

 namespace App\Http\Middlewares;

class Middleware
{
    public function next($request, $next = true)
    {
        return $next;
    }

    public static function class(): string
    {
        //@todo return class path to str
    }

}