<?php

require_once './src/Model/TestModel.php';

class TestManager extends Manager
{
    public static function test($id){
        self::addJsonResults("server", $_SERVER);
    }

}