<?php

require_once "./src/Model/UserModel.php";

class LoginManager extends Manager
{
    public static function signUpUser($formBean)
    {
        self::addJsonResults("user", UserModel::editUser($formBean->userFormBean));
    }

    public static function signInUser($formBean)
    {
        self::addJsonResults("user", UserModel::loginUSER($formBean->loginFormBean));
    }

    public static function isNewUsernameValid($username)
    {
        self::addJsonResults("isValid", UserModel::getUserByUsernameCheck($username));
    }

}