<?php

require_once 'Commons.php';


abstract class Firebase extends Commons
{

    const EQUAL = "EQUAL";
    const LIKE = "LIKE";

    public static function grab($url, $method, $par = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (isset($par)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $par);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }


    public static function insert($table, $data)
    {
        $path = self::FIREBASE_URL() . "/$table.json";
        $grab = self::grab($path, "POST", json_encode($data));
        return $grab;
    }

    public static function saveOrUpdate($object)
    {

        $table = self::getTableName($object);

        $path = self::FIREBASE_URL() . "/$table/$object->id.json";
        $id = $object->id;
        unset($object->id);
        $grab = self::grab($path, "PATCH", json_encode($object));
        return self::find($object, $id);
    }

    public static function delete($dto, $id)
    {
        $table = self::getTableName($dto);
        $path = self::FIREBASE_URL() . "/$table/$id.json";
        $grab = self::grab($path, "DELETE");
        return $grab;
    }

    public static function fetch($dbPath, $queryKey = null, $queryType = null, $queryVal = null)
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
        $path = self::FIREBASE_URL() . "/$dbPath.json$pars";

        $grab = self::grab($path, "GET");
        return $grab;
    }

    public static function fetchWithInteger($dbPath, $queryKey, $queryVal)
    {

        $queryVal = urlencode($queryVal);
        $pars = "?orderBy=\"$queryKey\"&equalTo=$queryVal";
        $path = self::FIREBASE_URL() . "/$dbPath.json$pars";
        return self::grab($path, "GET");
    }

    public static function findWhereEqual($dto, $key, $value, $valueIsInt = false)
    {
        $final = null;
        $table = self::getTableName($dto);
        if ($valueIsInt) {
            $final = self::fetchWithInteger($table, $key, $value);
        } else {
            $final = self::fetch($table, $key, "EQUAL", $value);

        }
        return $dto::build_list(json_decode($final, true));
    }

    public static function find($dto, $id)
    {
        $table = self::getTableName($dto);
        return $dto::build($id, json_decode(self::fetch("$table/$id")));
    }

}