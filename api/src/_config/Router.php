<?php
require_once 'Manager.php';

Manager::fetchManagerFiles();

class Router extends Manager
{

    public static $parameters;
    public static $params;
    public static $bodyData;
    public static $route;

    public function __construct($response)
    {
        self::$route = self::route();
        self::$response = $response;
        self::$params = self::$route[1] ?? null;
        self::$bodyData = self::inputs();
        self::$parameters = json_decode(json_encode(["params" => self::$params, "data" => self::$bodyData]));
    }

    static function REQ($route, $ActionMethod)
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

    public static function RESPONSE()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization, session_user");

        echo self::setResponse();
    }



    protected static function do($method, $params)
    {
        $finalMethod = "$method[0]::$method[1]";
        call_user_func($finalMethod, $params);
    }

}