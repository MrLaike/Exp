<?php

namespace App\Database;

class DB extends \PDO implements DBInterface
{

    public function __construct(
        $dsn = 'mysql:host=127.0.0.1;dbname=market;charset=utf8',
        $username = 'test',
        $passwd = 'password',
        array $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ])
    {
        parent::__construct($dsn, $username, $passwd, $options);
    }

    public function query(): array
    {
        // TODO: Implement query() method.
    }

}