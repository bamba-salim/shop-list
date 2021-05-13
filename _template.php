<?php require_once('./resources/config.php') ?>
<?php
  require_once('./resources/controllers/UserController.php');
  
?>
<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-template.js?vr=1"></script>

  <title>Page Template | <?= SITE_NAME ?></title>
</head>
<body>
<header>
  <?php include('./app/component/communs/Navbar.php') ?>
</header>

<main ng-controller="templateController">

</main>
<footer>

</footer>
</body>
</html>
