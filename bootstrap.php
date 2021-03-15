<?php
require_once 'autoload.php';
Autoloader::register();

require_once 'routes.php';


function collection($value) {
    return new \Kernel\Collection($value);
}

