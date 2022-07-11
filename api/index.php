<?php
if (!isset($_SESSION)) session_start();

date_default_timezone_set("Europe/Paris");

require "vendor/autoload.php";


$router = new App\lib\Router\Router($_GET['url']);

var_dump($router);

$router->run($_GET['url']);



