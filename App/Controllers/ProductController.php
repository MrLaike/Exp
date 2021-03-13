<?php

namespace App\Controllers;


use App\Models\Product;
use Kernel\Collection;

class ProductController
{

    public function index()
    {
        $products = new Product();
        $products = $products->index();

        $array = new Collection();
        $products->each(function ($data) use ($array) {
            $array->add($data['id'] + 1);
        })->first();

        var_dump($array);
    }
}