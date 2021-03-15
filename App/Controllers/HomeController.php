<?php

namespace App\Controllers;


use Kernel\View;

class HomeController
{

    public function index()
    {
        View::render('welcome');
    }

}