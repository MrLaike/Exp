<?php

use \Kernel\Router;

$router = new Router();


$router->get('/', [\App\Controllers\HomeController::class, 'index']);

$router->get('/clients', [\App\Controllers\ClientController::class, 'index']);
$router->post('/clients', [\App\Controllers\ClientController::class, 'store']);
$router->delete('/clients', [\App\Controllers\ClientController::class, 'delete']);
$router->put('/clients', [\App\Controllers\ClientController::class, 'update']);

$router->get('/orders', [\App\Controllers\OrderController::class, 'index']);
$router->post('/orders', [\App\Controllers\OrderController::class, 'store']);
$router->delete('/orders', [\App\Controllers\OrderController::class, 'delete']);
$router->put('/orders', [\App\Controllers\OrderController::class, 'update']);

$router->get('/products', [\App\Controllers\ProductController::class, 'index']);
$router->post('/products', [\App\Controllers\ProductController::class, 'store']);
$router->delete('/products', [\App\Controllers\ProductController::class, 'delete']);
$router->put('/products', [\App\Controllers\ProductController::class, 'update']);

$router->dispatch($_SERVER['REQUEST_URI']);
