<?php

require_once "./src/_config/Firebase.php";

require_once "./src/Mapping/UserDTO.php";


class UserModel extends Firebase
{

    public static function editUser($formBean)
    {
        $user = UserDTO::buildToSave($formBean);
        return self::saveOrUpdate($user);
    }

    public static function getUserByID($userID){
        return self::find(UserDTO::class, $userID);
    }

    public static function getUserByUsername($username)
    {
        $user = (array) json_decode(self::fetch("users", "username", self::EQUAL, $username));
        return !empty($user) ? UserDTO::buildFull(array_keys($user)[0],array_values($user)[0]) : null ;
    }

    public static function loginUSER($loginFormBean)
    {
        $user = UserModel::getUserByUsername($loginFormBean->username);
        if ($user === null) ExceptionConfig::DATA_NOT_FOUND()->throws("Identifiant ou mot de passe invalide.");
        if (!password_verify($loginFormBean->password, $user->getPassword())) ExceptionConfig::ACCESS_FORBIDDEN()->throws("Identifiant ou mot de passe invalide.");
        unset($user->password);
        return $user;
    }

    public static function getUserByUsernameCheck($username)
    {
        return sizeof(self::findWhereEqual(UserDTO::class,"username", $username)) === 0;

    }
}