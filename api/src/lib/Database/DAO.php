<?php

require_once 'Firebase.php';

abstract class DAO extends Firebase
{

    private static function send_request($url, $method, $data_header = null)
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        if (isset($data_header)) curl_setopt($request, CURLOPT_POSTFIELDS, $data_header);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($request, CURLOPT_TIMEOUT, 120);
        curl_setopt($request, CURLOPT_HEADER, 0);
        $curl_results = curl_exec($request);
        curl_close($request);
        return $curl_results;
    }

    protected static function _GET($path){
        return self::send_request($path, "GET");
    }

    protected static function _PATCH($path, $data){
        return self::send_request($path, "PATCH", $data);
    }

    protected static function _POST($path){
        return self::send_request($path, "POST");
    }

    protected static function _DELETE($path){
        return self::send_request($path, "DELETE");
    }


    protected static function Firebase(): Firebase
    {
        return new Firebase(get_called_class());
    }

}