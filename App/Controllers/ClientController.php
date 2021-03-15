<?php

namespace App\Controllers;

use App\Models\Client;
use Kernel\Controller;
use Kernel\HttpRequest\Request;
use Kernel\View;

class ClientController
{
    private $client;
    private $request;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index()
    {
        /** @var Client $client */
        $clients = $this->client->index();
        View::render('clients', $clients);
    }

    public function delete()
    {
        $request = Request::request();
        try {
            $this->client->deleteBy($request->id);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {

    }

    public function search()
    {

    }

    public function store()
    {
        $request = Request::request();

        $this->client->store($request);

        Request::reset();

        $this->index();
    }

}