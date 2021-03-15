<?php

namespace App\Controllers;

use App\Models\Order;
use Kernel\HttpRequest\Request;
use Kernel\View;

class OrderController
{
    private $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    public function index()
    {
        $orders = $this->order->index();
        View::render('order/orders', $orders);
    }

    public function create()
    {

    }

    public function delete()
    {
        $request = Request::request();

        $id = $request->id;

        try {
            $this->order->deleteBy($id);
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

}