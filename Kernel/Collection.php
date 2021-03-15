<?php

namespace Kernel;

class Collection
{
    /** @var array */
    private $data = [];

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    // TODO чет над сделать
    public function add($data = [])
    {
        $data = (is_array($data)) ?: array($data);
        foreach ($data as $value) {
            $this->data[] = $value;
        }
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if(array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }

    public function first(): self
    {

        if(!empty($this->data)) {
            $reversedData = array_reverse($this->data);
            $this->data = array_pop($reversedData);
        }

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    // TODO чет над сделать
    public function each(callable $callback)
    {
        foreach ($this->data as $data) {
            $callback($data);
        }

//        if(!is_null($newData)) $this->data = $newData;

        return $this;
    }

}