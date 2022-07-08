<?php
require_once 'Manager.php';
require_once "ExceptionConfig.php";


require_once "./src/_config/Model/Route.php";

Manager::fetchManagerFiles();

class Router extends Manager
{

    public static $parameters;
    public static $params;
    public static $bodyData;
    public static array $route;
    public static array $results = [];

    public function __construct($route)
    {
        self::$route = $route;
        self::$results = [];
        self::$params = self::$route[1] ?? null;
        self::$bodyData = self::inputs();
        self::$parameters = json_decode(json_encode(["params" => self::$params, "data" => self::$bodyData]));
    }

    static function INIT_ROUTE()
    {
        $_SESSION['ROUTE_LIST'] = [];
        self::includesRouterFiles();
    }

    static function show_routes(){
        Router::addJsonResults("list", $_SESSION['ROUTE_LIST']);
        Router::run();
    }

    static function show_server(){
        Router::addJsonResults("server", $_SERVER);
        Router::run();
    }

    static function works()
    {
        try {
            self::INIT_ROUTE();
            $router = new Router(self::route_v1());
            $routeList = array_filter($_SESSION['ROUTE_LIST'], function ($r) {
                if (empty(self::route_v1())) ExceptionConfig::PAGE_NOT_FOUND()->throws();
                return $r->name === self::route_v1()[0];
            });

            ExceptionConfig::RouteNotFound($routeList);

            /* @var $route Route */
            $route = $routeList[array_keys($routeList)[0]];
            $router::REQ($route->getMethod(), $route->getName(), $route->getClass(), $route->getFunction());
            $router::run();

        } catch (Exception $e) {
            ExceptionConfig::e_error(['error' => $e->getMessage()]);
        }
    }

    static function ROUTES($routesList)
    {
        array_push($_SESSION['ROUTE_LIST'], ...$routesList);
    }

    static function REQ($method, $name, $class, $function)
    {
        call_user_func_array(['self', $method], [$name, [$class, $function]]);
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
        if ((!empty(self::$route) ? self::$route[0] : "" === $route) && $_SERVER['REQUEST_METHOD'] === 'GET') {
            self::do($ActionMethod, self::$params);
        }
    }

    static function POST($route, $ActionMethod)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");
        if ((!empty(self::$route) ? self::$route[0] : "" === $route) && $_SERVER['REQUEST_METHOD'] === 'POST') self::do($ActionMethod, self::$bodyData);
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

    public static function run()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");

        echo self::setResults();
    }

    public static function includesRouterFiles()
    {
        foreach (scandir('./src/Router') as $router) if (!str_starts_with($router, ".")) include_once "./src/Router/$router";

    }
}