<?php

require_once 'Manager.php';
require_once './src/_config/Model/Status.php';

abstract class ExceptionConfig extends Manager
{
    static function AdminAccessException()
    {
        if (!self::UserSession()->isAdmin) ExceptionConfig::ACCESS_FORBIDDEN()->throws();
    }

    static function AllreadyLoginException()
    {
        if (self::UserSession()->id != null) ExceptionConfig::ALREADY_EXISTS()->throws("You are already logged in !");

    }

    static function UserIdOrAdminException($idUser)
    {
        if (!(self::UserSession()->id == $idUser || self::UserSession()->isAdmin)) ExceptionConfig::ACCESS_FORBIDDEN()->throws();

    }

    static function UserIdException($idUser)
    {
        if (self::UserSession()->id != $idUser) ExceptionConfig::ACCESS_FORBIDDEN()->throws();
    }

    static function ArgsException($args, $isInt = false)
    {
        if (empty($args)) ExceptionConfig::ERR_ARGS_MISS()->throws();
        if ($isInt && !self::isInteger($args)) ExceptionConfig::ERR_ARGS_TYPE()->throws();
    }

    static function DataException($data, $isInt = false)
    {
        $inputs = self::inputs();
        if ($inputs === null) ExceptionConfig::ERR_ARGS_MISS()->throws();
        if (!property_exists($inputs, $data)) ExceptionConfig::ERR_ARGS_MISS()->throws("Missing '$data' !");
        if ($isInt && !self::isInteger($inputs->$data)) ExceptionConfig::ERR_ARGS_TYPE()->throws();
        return $inputs->$data;
    }

    public static function RouteNotFound(array $route)
    {
        if (empty($route)) ExceptionConfig::PAGE_NOT_FOUND()->throws();
    }

    public static function ERR_ARGS_MISS(): Status
    {
        return new Status(400, "Bad Request", "Missing Args !");
    }

    public static function ERR_ARGS_TYPE(): Status
    {
        return new Status(400, "Bad Request", "Wrong Args type !");
    }

    public static function ACCESS_FORBIDDEN(): Status
    {
        return new Status(403, "Forbidden", "Don't have permissions !");
    }

    public static function PAGE_NOT_FOUND(): Status
    {
        return new Status(404, "Not Found", "Page doesn't exist !");
    }

    public static function ALREADY_EXISTS(): Status
    {
        return new Status(409, "Conflict", "Resource already exists !");
    }

    public static function DATA_NOT_FOUND(): Status
    {
        return new Status(204, "No Content", "No data return !");
    }

    public static function SUCCESS($action = null, $message = null): Status
    {
        return new Status(200, $action ?? "SUCCESS", $message ?? "ALL IS GOOD !");
    }


}
