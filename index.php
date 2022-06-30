<!doctype html>
<html lang="fr" ng-app="rootApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOP-LIST</title>

    <?php include './app/head-inc.php' ?>
</head>
<body ng-controller="appController" ng-init="_appInit()">
<header ng-include="'./app/views/home/header-inc.php'"></header>

<main class="container">
    <ui-view></ui-view>
</main>

</body>
</html>