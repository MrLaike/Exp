<?php

include 'autoload.php';

Autoloader::register();

use \Kernel\Router;

$router = new Router();


//$router->get();
//$client = new \App\Controllers\ClientController();
//$client->index();
//$class = new \ReflectionClass('OrderController');


$router->get('client', [\App\Controllers\ClientController::class, 'index']);
$router->get('orders', [\App\Controllers\OrderController::class, 'index']);

$router->dispatch($_SERVER['REQUEST_URI']);