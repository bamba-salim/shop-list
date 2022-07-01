<?php
if (!isset($_SESSION)) session_start();

date_default_timezone_set("Europe/Paris");

require_once './src/_config/ExceptionConfig.php';
require_once './src/_config/Router.php';
require_once "./src/_config/Model/Route.php";


Router::INIT_ROUTE();


$router = new Router([]);
try {

    /* @var $route Route */
    foreach ($_SESSION['ROUTE_LIST'] as $route) {
        $router->REQ($route->getMethod(), $route->getName(), $route->getClass(), $route->getFunction());
    }

    empty($router::$results) ? ExceptionConfig::PAGE_NOT_FOUND()->throws() : Router::RESULTS();

} catch (Exception $e) {
    ExceptionConfig::e_error(['error' => $e->getMessage()]);
}

