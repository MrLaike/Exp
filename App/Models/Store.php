<?php

namespace App\Models;


use Kernel\Model;

class Store extends Model
{
    /**
     * @override
     * @var string
     */
    protected $table = 'store';

    public function index() {
        return $this->get();
    }

}