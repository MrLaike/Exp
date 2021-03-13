<?php

namespace Kernel\Database;

interface DBInterface
{

    public function get();
    public function find($params);

}