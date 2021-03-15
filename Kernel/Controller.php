<?php
/**
 * Created by PhpStorm.
 * User: mrlaike
 * Date: 3/14/21
 * Time: 6:37 PM
 */

namespace Kernel;


class Controller
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

}