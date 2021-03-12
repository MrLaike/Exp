<?php

namespace App\Controllers;

use App\Models\Client;
use Kernel\View;

class ClientController
{
    public function index()
    {
        $data = [
            'name' => 'HER',
            'surname' => 'DRE',
        ];
        (new Client())->create();
        View::render('client', $data);
    }

    public function delete()
    {


    }

    public function update()
    {

    }

    public function search()
    {

    }
}