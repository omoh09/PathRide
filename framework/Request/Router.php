<?php
namespace Framework\Request;

use Framework\Request\Interfaces\RequestInterface;

class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    function __call($name, $args)
    {
        list($route, $resolver) = $args;

        if(!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }

        //check if the args passed in a callback
        if (is_callable($resolver)) $this->{strtolower($name)}[$this->formatRoute($route)] = $resolver;

        //inject
        if (is_string($resolver)) {
            $strToArr = explode('@', $resolver);
            $controllerStr = "App\\Http\\Controller\\{$strToArr[0]}";
            $controller = new $controllerStr();
            $method = $controller->{$strToArr[1]}();


            $this->{strtolower($name)}[$this->formatRoute($route)] = function ($request) use ($method) {
                return $method;
            };
        }

    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * Resolves a route
     */
    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];

        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct()
    {
        $this->resolve();
    }
}