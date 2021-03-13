<?php

namespace App\Controllers;

use App\Models\Client;
use Kernel\View;

class ClientController
{
    public function index()
    {
        /** @var Client $client */
        $client = new Client();
        $data = $client->create();
        var_dump($data->title);
        View::render('client', []);
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