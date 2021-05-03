<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-index.js?vr=0"></script>

  <script>
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("shopModule");
  </script>
  <title>Page d'accueil | <?= SITE_NAME ?></title>
</head>
<body>
<header>
  <?php include('./app/component/communs/Navbar.php') ?>
</header>

<main ng-controller="shopController">

</main>
<footer>

</footer>
</body>
</html>
