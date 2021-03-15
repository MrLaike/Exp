<?php
/**
 * Created by PhpStorm.
 * User: mrlaike
 * Date: 3/13/21
 * Time: 6:41 AM
 */

namespace App\Models;

use Kernel\Collection;
use Kernel\Model;

class Product extends Model
{
    public function index(): Collection
    {
        return $this->get();
    }
}