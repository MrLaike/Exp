<?php

namespace App\Controllers;


use App\Models\Product;
use Kernel\Collection;
use Kernel\View;

class ProductController
{

    public function index()
    {
        $products = new Product();
        $products = $products->index();

        View::render('products', $products);
    }

    public function store()
    {
        var_dump('Все чику пуки');
    }
}