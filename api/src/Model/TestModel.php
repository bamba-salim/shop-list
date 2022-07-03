<?php

require_once "./src/_config/Database/DAO.php";

class TestModel extends DAO
{

    public static function test($id)
    {
        return self::Firebase()::TestFirebase($id);
    }
}