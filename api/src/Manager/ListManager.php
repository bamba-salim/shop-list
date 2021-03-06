<?php

require_once './src/Model/ListModel.php';


class ListManager extends Manager
{

    public static function deleteLists($inputs)
    {
        ListModel::deleteListsDB($inputs->idsList);
        self::addSuccesResults("DELETE", sizeof($inputs->idsList) . " listes ont bien été supprimées !");
    }

    public static function deleteItemList($inputs)
    {

        self::addSuccesResults("DELETE", sizeof($inputs->idsItem) . " items ont bien été supprimés !");
    }

    public static function fetchListsByUser($userID)
    {
        self::addJsonResults("userLists", ListModel::getListByUser($userID));
    }

    public static function fetchListWithProduct($listID)
    {
        ExceptionConfig::ArgsException($listID);
        $itemList = ListModel::getItemsByList($listID);
        self::addJsonResults("list", ListModel::getListById($listID));
        self::addJsonResults("listInfos", ListModel::setListInfos($itemList));
        self::addJsonResults("itemsList", $itemList);
    }

    public static function saveNewList($inputs)
    {
        self::addJsonResults("list", ListModel::editListDB($inputs->listFormBean));
    }

    public static function saveNewItemList($inputs)
    {
        self::addJsonResults("list", ListModel::editItemDB($inputs->itemFormBean));
    }


}