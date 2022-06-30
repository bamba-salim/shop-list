<?php

require_once './src/_config/DTO.php';

class ItemDTO extends DTO
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $quantity;
    public $list;

    public static function build($id, $itemDB)
    {

        $itemDTO = new ItemDTO();
        $itemDTO->setId($id);
        $itemDTO->setName($itemDB->name);
        $itemDTO->setDescription($itemDB->description);
        $itemDTO->setPrice($itemDB->price);
        $itemDTO->setQuantity($itemDB->quantity);
        $itemDTO->setList($itemDB->list);
        return $itemDTO;
    }

    public static function buildToSave($inputs)
    {
        $itemDTO = new ItemDTO();
        $itemDTO->setId($inputs->id ?? uniqid());
        $itemDTO->setName($inputs->name);
        $itemDTO->setDescription($inputs->description ?? "");
        $itemDTO->setPrice($inputs->price);
        $itemDTO->setQuantity($inputs->quantity);
        $itemDTO->setList($inputs->list);
        return $itemDTO;
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

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList($list): void
    {
        $this->list = $list;
    }






}