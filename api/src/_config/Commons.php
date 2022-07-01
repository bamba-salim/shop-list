<?php
require_once 'DotEnv.php';


abstract class Commons
{

    public static function FIREBASE_URL(){
        return DotEnv::find("FIREBASE_URL");
    }

    public static function inputs()
    {
        $data = json_decode(file_get_contents('php://input'));

        return $data->data ?? $data;
    }

    public static function ArrayToObject($array)
    {
        return gettype($array) === 'array' ? json_decode(json_encode($array)) : $array;
    }

    public static function isInteger($value)
    {
        return is_int($value) || ctype_digit($value);

    }

    public static function route()
    {
        return explode("/", isset($_GET['url']) ? filter_var($_GET['url']) : "", FILTER_SANITIZE_URL);
    }

    public static function e_error($err)
    {
        return die(json_encode(["ERROR" => $err]));
    }

    public static function getTableName($class)
    {
        $finalClass = gettype($class) === "string" ? $class : get_class($class);
        return strtolower(str_replace("DTO", "", $finalClass)) . 's';
    }

    protected static function do($arrayethod, $params)
    {
        $finalMethod = "$arrayethod[0]::$arrayethod[1]";
        call_user_func($finalMethod, $params);
    }
}