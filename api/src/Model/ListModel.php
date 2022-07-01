<?php

require_once "./src/_config/Firebase.php";


require_once "./src/Mapping/ListDTO.php";
require_once "./src/Mapping/ItemDTO.php";

class ListModel extends Firebase
{


    public static function getListById($id)
    {
        return self::find(ListDTO::class, $id);
    }

    public static function getListByUser($userID)
    {
        return self::findWhereEqual(ListDTO::class, "user", $userID);
    }


    public static function getItemsByList($listId)
    {
        return self::findWhereEqual(ItemDTO::class, 'list', $listId);
    }

    public static function editListDB($formBean)
    {
        $list = ListDTO::buildToSave($formBean);
        self::saveOrUpdate($list);
        return $list;
    }

    public static function editItemDB($formBean)
    {
        $item = ItemDTO::buildToSave($formBean);
        self::saveOrUpdate($item);
        return $item;
    }

    public static function deleteItemsDB($idsItem)
    {
        foreach ($idsItem as $idItem) {
            self::delete(ItemDTO::class, $idItem);

        }
    }

    public static function deleteListsDB($idsList)
    {
        foreach ($idsList as $idList){
            $idsItem = array_column(self::getItemsByList($idList), "id");
            self::deleteItemsDB($idsItem);

            self::delete(ListDTO::class, $idList);
        }

    }
    public static function setListInfos(array $itemList)
    {

        // prix total

        // total item différent

        // total item


        return "en cours";
    }

}