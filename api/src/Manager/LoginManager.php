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
        $user = UserModel::loginUSER($formBean->loginFormBean);
        self::addJsonResults("user", UserModel::getUserByID($user->getId()));
    }

    public static function isNewUsernameValid($username)
    {
        self::addJsonResults("isValid", UserModel::getUserByUsernameCheck($username));
    }

}