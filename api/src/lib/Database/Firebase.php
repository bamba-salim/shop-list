<?php

require_once './src/_config/Commons.php';
require_once './src/_config/DotEnv.php';


class Firebase extends Commons
{


    private static string $FIREBASE_URL;
    protected const EQUAL = "EQUAL";
    protected const LIKE = "LIKE";
    private static string $model_name;

    /**
     * @param string $model_name
     */
    public function __construct(string $model_name = "Firebase")
    {
        self::$FIREBASE_URL = DotEnv::find("FIREBASE_URL");
        self::$model_name = $model_name;
    }


    protected static function TestFirebase($id)
    {
        return json_decode(self::get("users/$id"));
    }

    protected static function insert($table, $data)
    {
        $path = self::$FIREBASE_URL . "/$table.json";
        $grab = call_user_func(self::$model_name . "::_POST", $path, json_encode($data));
        return $grab;
    }

    protected static function saveOrUpdate($object)
    {
        $table = self::getTableName($object);
        $path = self::$FIREBASE_URL . "/$table/$object->id.json";
        $id = $object->id;
        unset($object->id);
        $grab = call_user_func(self::$model_name . "::_PATCH", $path, json_encode($object));
        return self::find($object, $id);
    }

    protected static function delete($dto, $id)
    {
        $table = self::getTableName($dto);
        $path = self::$FIREBASE_URL . "/$table/$id.json";
        $grab = call_user_func(self::$model_name . "::_DELETE", $path);
        return $grab;
    }

    protected static function get($dbPath, $queryKey = null, $queryType = null, $queryVal = null)
    {
        if (isset($queryType) && isset($queryKey) && isset($queryVal)) {
            $queryVal = urlencode($queryVal);
            if ($queryType == "EQUAL") {
                $pars = "orderBy=\"$queryKey\"&equalTo=\"$queryVal\"";
            } elseif ($queryType == "LIKE") {
                $pars = "orderBy=\"$queryKey\"&startAt=\"$queryVal\"";
            }
        }
        $pars = isset($pars) ? "?$pars" : "";
        $path = self::$FIREBASE_URL . "/$dbPath.json$pars";

        $grab = call_user_func(self::$model_name . "::_GET", $path);
        return $grab;
    }

    protected static function fetchByInteger($dbPath, $queryKey, $queryVal)
    {
        $queryVal = urlencode($queryVal);
        $pars = "?orderBy=\"$queryKey\"&equalTo=$queryVal";
        $path = self::$FIREBASE_URL . "/$dbPath.json$pars";
        return call_user_func(self::$model_name . "::_GET", $path);
    }

    protected static function findWithFilter($dto, $key, $value)
    {
        $table = self::getTableName($dto);
        return $dto::build_list(json_decode(self::get($table, $key, "EQUAL", $value), true));
    }

    protected static function find($dto, $id)
    {
        $table = self::getTableName($dto);
        return $dto::build($id, json_decode(self::get("$table/$id")));
    }

}