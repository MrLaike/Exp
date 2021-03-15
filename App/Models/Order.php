<?php

namespace App\Models;

use Kernel\Model;

class Order extends Model
{

    public function index()
    {
        return $this->leftJoin('clients', 'clients.id',
                        '=', 'orders.client_id',
                        'clients.*, orders.*')->get();
    }

    public function deleteBy($id)
    {
        return $this->delete($id);
    }
}