<?php

require_once 'Commons.php';

abstract class Manager extends Commons
{
    public static array $results;

    public static function fetchManagerFiles()
    {
        foreach (scandir('./src/Manager') as $manager) if (!str_starts_with($manager, ".")) require_once "./src/Manager/$manager";
    }

    public static function savon(){
        self::addJsonResults("savon", "elle est bonne sa mère");
    }

    protected static function addSuccesResults($action, $message)
    {
        self::$results["SUCCESS"] = ExceptionConfig::SUCCESS($action, $message);
    }

    protected static function addJsonResults($item, $data)
    {
        self::$results[$item] = $data;
    }

    protected static function setResults()
    {
        return json_encode(self::ArrayToObject(self::$results));
    }

}