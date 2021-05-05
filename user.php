<?php require_once('./resources/config.php') ?>
<?php //if (!isset($_GET['id'])) header("location: ./ ") ?>
<?php //$idUser = $_GET['id'] ?>
<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-user.js?vr=0"></script>

  <script>
    _unlog_redirect();
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("userModule");
  </script>

  <title>Fiche user | <?= SITE_NAME ?></title>
</head>
<body class="bg-gray-50">
<?php include('./app/component/communs/Navbar.php') ?>

<main ng-controller="userController" ng-init="_onInit()">
  {{ user }}
</main>
<footer>

</footer>
</body>
</html>
