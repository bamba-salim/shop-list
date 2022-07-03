<?php

require_once "./src/_config/Database/DAO.php";


require_once "./src/Mapping/ListDTO.php";
require_once "./src/Mapping/ItemDTO.php";

class ListModel extends DAO
{


    public static function getListById($id)
    {
        return self::Firebase()::find(ListDTO::class, $id);
    }

    public static function getListByUser($userID)
    {
        return self::Firebase()::findWithFilter(ListDTO::class, "user", $userID);
    }


    public static function getItemsByList($listId)
    {
        return self::Firebase()::findWithFilter(ItemDTO::class, 'list', $listId);
    }

    public static function editListDB($formBean)
    {
        $list = ListDTO::buildToSave($formBean);
        self::Firebase()::saveOrUpdate($list);
        return $list;
    }

    public static function editItemDB($formBean)
    {
        $item = ItemDTO::buildToSave($formBean);
        self::Firebase()::saveOrUpdate($item);
        return $item;
    }

    public static function deleteItemsDB($idsItem)
    {
        foreach ($idsItem as $idItem) {
            self::Firebase()::delete(ItemDTO::class, $idItem);

        }
    }

    public static function deleteListsDB($idsList)
    {
        foreach ($idsList as $idList) {
            $idsItem = array_column(self::getItemsByList($idList), "id");
            self::deleteItemsDB($idsItem);

            self::Firebase()::delete(ListDTO::class, $idList);
        }

    }

    public static function setListInfos($itemList)
    {
        return ListDTO::BuildListInfos($itemList);
    }


}