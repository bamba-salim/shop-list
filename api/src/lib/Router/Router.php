<?php

namespace App\lib\Router;

class Router
{

    private $path;
    private $routes = [];

    public function __construct($path)
    {
        $this->path = trim($path, '/');
        $this->routes = $_SESSION["ROUTE_LIST"];
    }

    public function GET($path, $callable)
    {

        $url = trim($path);
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if (!preg_match ($regex, $url, $matches) ) {
            return false;
        }
        var_dump($matches);
       // $route = new Route();

    }

    public function run($url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if (!preg_match ($regex, $url, $matches) ) {
            return false;
        }
        var_dump($matches);
    }
}