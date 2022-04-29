<?php

namespace Framework\Model\Classes;

use Framework\Model\AbstractClasses\BaseModel;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\Types\This;

class Model extends BaseModel
{
    public static function __callStatic($name, $arguments)
    {
        (new self)->resolveInstancePropertyCall(new self, $name, $arguments);
    }

    public  function __call(string $name, array $arguments)
    {
        $this->resolveInstancePropertyCall($this, $name, $arguments);
    }

    protected function resolveInstancePropertyCall($instance, string $name, array $arguments)
    {
        $allowed_methods = [
            'find' => 'findWithId',
            'all' => 'callAll',
            'get' => 'callGet',
        ];

        $allowed_methods_keys = array_keys($allowed_methods);

        if (! (in_array($name, $allowed_methods_keys))) {
            throw new \Exception('Method Not Defined');
        }

        $params = [...$arguments];
        return $instance->{$allowed_methods[$name]}(...$params);
    }
}
