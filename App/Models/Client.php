<?php

namespace App\Models;

use Kernel\Model;

class Client extends Model
{

    public function create()
    {
        return $this->get();
    }

}