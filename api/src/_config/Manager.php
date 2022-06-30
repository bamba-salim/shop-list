<?php

require_once 'Firebase.php';

abstract class Manager extends Commons
{
    public static array $response;

    protected static $results;
    public static $arrayTest;

    public static function fetchManagerFiles()
    {
        foreach (scandir('./src/Action') as $manager) if (!str_starts_with($manager, ".")) require_once "./src/Action/$manager";
    }

    protected static function do($method, $params)
    {
        $finalMethod = "$method[0]::$method[1]";
        call_user_func($finalMethod, $params);
    }

    protected static function addSuccesResults($action, $message){
        self::$response["SUCCESS"] = ExceptionConfig::SUCCESS($action,$message);
    }

    protected static function addJsonResults($item, $data)
    {
        self::$response[$item] = $data;
    }

    protected static function setResponse()
    {
        return json_encode(self::ArrayToObject(self::$response));
    }
}