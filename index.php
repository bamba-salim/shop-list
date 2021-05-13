<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-index.js?vr=1"></script>

  <script>
    _unlog_redirect()
  </script>
  <title>Page d'accueil | <?= SITE_NAME ?></title>
</head>
<body>
<?php include('./app/component/communs/Navbar.php') ?>

<main ng-controller="shopController">

</main>
<footer>

</footer>
</body>
</html>
