<html lang="fr" ng-app="rootApp" ng-controller="main">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-index.js?vr=1"></script>

  <script>
    _unlog_redirect()
  </script>
  <title>Page d'accueil | {{ SITE_NAME }}</title>
</head>
<body>
<?php include('./app/component/communs/Navbar.php') ?>

<main ng-controller="shopController">
{{ testUnitaire }} {{ SITE_NAME }}
</main>
<footer>

</footer>
</body>
</html>
