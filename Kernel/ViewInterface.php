<?php

namespace Kernel;


interface ViewInterface
{
    /**
     * @param string $view
     * @param mixed $data
     * @return void
     */
    public static function render(string $view, $data = []): void;
}