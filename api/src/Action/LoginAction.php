<?php

require_once "./src/Model/UserModel.php";

class LoginAction extends Manager
{
    public static function signUpUser($formBean)
    {
        self::addJsonResults("user", UserModel::creatUser($formBean->userFormBean));
    }

    public static function signInUser($formBean)
    {
        $user = UserModel::loginUSER($formBean->loginFormBean);
        self::addJsonResults("user", UserModel::getUserByID($user->getId()));
    }

}