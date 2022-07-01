<?php

require_once './src/_config/DTO.php';

class UserDTO extends DTO
{
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $isAdmin;
    public $password;

    public static function build($id, $userDB)
    {

        $userDTO = new UserDTO();
        $userDTO->setId($id);
        $userDTO->setUserName($userDB->username);
        $userDTO->setLastname($userDB->lastname);
        $userDTO->setFirstname($userDB->firstname);
        $userDTO->setIsAdmin($userDB->isAdmin);
        unset($userDTO->password);
        return $userDTO;
    }

    public static function buildFull($fromDB){
        $userDB = array_values($fromDB);
        $id = array_keys($fromDB);

        $userDTO = new UserDTO();
        $userDTO->setId($id[0]);
        $userDTO->setUserName($userDB[0]->username);
        $userDTO->setLastname($userDB[0]->lastname);
        $userDTO->setFirstname($userDB[0]->firstname);
        $userDTO->setIsAdmin($userDB[0]->isAdmin);
        $userDTO->setPassword($userDB[0]->password);
        return $userDTO;
    }

    public static function buildToSave($inputs)
    {
        $userDTO = new UserDTO();
        $userDTO->setId($inputs->id ?? uniqid());
        $userDTO->setUsername($inputs->username);
        $userDTO->setFirstname($inputs->firstname ?? "");
        $userDTO->setLastname($inputs->lastname ?? "");
        $userDTO->setIsAdmin($inputs->isAdmin ?? false);
        $userDTO->setPassword(password_hash($inputs->password, PASSWORD_BCRYPT));
        return $userDTO;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }







}