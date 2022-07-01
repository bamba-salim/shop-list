<?php

Router::ROUTES([
    ##### GET
    new Route("fetch-list", "GET", [ListManager::class, "fetchListWithProduct"]),
    new Route("fetch-user-list", "GET", [ListManager::class, "fetchListsByUser"]),

    ##### EDIT
    new Route("save-new-list", "POST", [ListManager::class, "saveNewList"]),
    new Route("save-new-item-list", "POST", [ListManager::class, "saveNewItemList"]),

    ##### DELETE
    new Route("delete-item-list", "POST", [ListManager::class, "deleteItemList"]),
    new Route("delete-lists", "POST", [ListManager::class, "deleteLists"])
]);



