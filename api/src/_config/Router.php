<?php
require_once 'Manager.php';

Manager::fetchManagerFiles();

class Router extends Manager
{

    public static $parameters;
    public static $params;
    public static $bodyData;
    public static $route;

    public function __construct($results)
    {
        self::$route = self::route();
        self::$results = $results;
        self::$params = self::$route[1] ?? null;
        self::$bodyData = self::inputs();
        self::$parameters = json_decode(json_encode(["params" => self::$params, "data" => self::$bodyData]));
    }

    static function INIT_ROUTE(){
        $_SESSION['ROUTE_LIST'] = [];
        self::includesRouterFiles();
    }

    static function ROUTES($routesList){
        array_push($_SESSION['ROUTE_LIST'], ...$routesList);
    }

    function REQ($method, $name, $class, $function)
    {
        call_user_func_array([$this, $method], [$name, [$class, $function]]);
    }

    static function QUERY($route, $ActionMethod)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");
        if (self::$route[0] === $route) self::do($ActionMethod, self::$parameters);
    }

    static function GET($route, $ActionMethod)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");
        if (self::$route[0] === $route && $_SERVER['REQUEST_METHOD'] === 'GET') {
            self::do($ActionMethod, self::$params);
        }
    }

    static function POST($route, $ActionMethod)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");
        if (self::$route[0] === $route && $_SERVER['REQUEST_METHOD'] === 'POST') self::do($ActionMethod, self::$bodyData);
    }

    static function PUT($route, $ActionMethod)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");
        if (self::$route[0] === $route && $_SERVER['REQUEST_METHOD'] === 'PUT') self::do($ActionMethod, self::$bodyData);
    }


    public static function JSON($data)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");

        echo json_encode($data);
    }

    public static function RESULTS()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");

        echo self::setResults();
    }

    public static function includesRouterFiles(){
        foreach (scandir('./src/Router') as $router) if (!str_starts_with($router, ".")) include_once "./src/Router/$router";

    }
}