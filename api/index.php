<?php
if (!isset($_SESSION)) session_start();

date_default_timezone_set("Europe/Paris");
require_once './src/_config/ExceptionConfig.php';

require_once './src/_config/Router.php';
$route = new Router([]);
try {
    $route::post('test',[ListAction::class, "test"]);

    $route::get("fetch-list",[ListAction::class, "fetchListWithProduct"] );
    $route::get("fetch-user-list",[ListAction::class, "fetchListsByUser"] );


    $route::post("sign-up-new-user", [LoginAction::class, "signUpUser"]);
    $route::post("sing-in-user", [LoginAction::class, "signInUser"]);
    $route::post("save-new-list", [ListAction::class, "saveNewList"]);
    $route::post("save-new-item-list", [ListAction::class, "saveNewItemList"]);
    $route::post("delete-item-list", [ListAction::class, "delteItemList"]);
    $route::post("delete-lists", [ListAction::class, "deleteLists"]);

    empty($route::$response) ? ExceptionConfig::PAGE_NOT_FOUND()->throws() : Router::RESPONSE();

} catch (Exception $e) {
    ExceptionConfig::e_error(['error' => $e->getMessage()]);
}

