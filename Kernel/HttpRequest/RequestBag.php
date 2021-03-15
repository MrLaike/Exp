<?php

namespace Kernel\HttpRequest;


class RequestBag
{
    private $request = [];

    public function __construct($request = [])
    {
        $this->request = $request;
    }

    public function __set($key, $value)
    {
        $this->request[$key] = $value;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->request)) {
            return $this->request[$key];
        }

        return null;
    }
}