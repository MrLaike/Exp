<?php

namespace Kernel\Database;

class DB extends \PDO implements DBInterface
{
    private $sql;

    public function __construct()
    {
        //TODO вынести в конфиг
        $dsn = 'mysql:dbname=market;host=localhost;port=3306;charset=utf8';
        $username = 'test';
        $passwd = 'password';

        parent::__construct($dsn, $username, $passwd);
        // Убираем возврат номера строки с индексом 0 (\PDO::FETCH_BOTH)
        $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function find($params)
    {
        $this->sql = $params;
        return $this;
    }

    public function get()
    {
        $result = $this->query($this->sql);
        return $result;
    }

}