<?php

use \Kernel\Router;

$router = new Router();


$router->get('client', [\App\Controllers\ClientController::class, 'index']);
$router->get('orders', [\App\Controllers\OrderController::class, 'index']);
$router->get('products', [\App\Controllers\ProductController::class, 'index']);

$router->dispatch($_SERVER['REQUEST_URI']);
