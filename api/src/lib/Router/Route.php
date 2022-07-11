<?php

namespace App\lib\Router;

class Route
{
    private $path;
    private $callable;

    /**
     * @param $path
     * @param $callable
     */
    public function __construct($path, $callable)
    {
        $this->path = $path;
        $this->callable = $callable;
    }


}