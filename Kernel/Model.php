<?php
namespace Kernel;

use App\Database\DBInterface;

abstract class Model
{
    private $db;

    public function __construct(DBInterface $db)
    {
        $this->db = $db;
    }

    public function get()
    {
        var_dump($this->db);
    }

}