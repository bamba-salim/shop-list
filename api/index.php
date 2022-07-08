<?php
if (!isset($_SESSION)) session_start();

date_default_timezone_set("Europe/Paris");

require_once './src/_config/Router.php';

Router::works();



