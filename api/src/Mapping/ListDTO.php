<?php

require_once './src/_config/DTO.php';

class ListDTO extends DTO
{
    public $id;
    public $name;
    public $description;
    public $user;

    public static function build($id, $listDB)
    {
        $list = new ListDTO();
        $list->setId($id);
        $list->setName($listDB->name ?? null);
        $list->setDescription($listDB->description ?? null);
        $list->setUser($listDB->user ?? null);
        return $list;
    }


    public static function buildToSave($inputs)
    {
        $listDTO = new ListDTO();
        $listDTO->setId($inputs->id ?? uniqid());
        $listDTO->setName($inputs->name ?? null);
        $listDTO->setDescription($inputs->description ?? null);
        $listDTO->setUser($inputs->user ?? null);
        return $listDTO;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }




}