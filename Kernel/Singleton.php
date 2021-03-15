<?php
/**
 * Created by PhpStorm.
 * User: mrlaike
 * Date: 3/14/21
 * Time: 7:09 PM
 */

namespace Kernel;


class Singleton
{
    private static $instances = [];

    protected function __construct()
    {
        $this->instance();
    }

    public static function getInstance()
    {
        $subclass = static::class;
        if(!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }

        return self::$instances[$subclass];
    }

    /** Убераем возможность клонирования */
    public function __clone() {}
}