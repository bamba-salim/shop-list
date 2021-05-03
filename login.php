<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>
  <!--  <script src="./app/assets/js/javascript_utils.js"></script>-->

  <script type="text/javascript" src="./app/component/js/js-login.js?vr=3"></script>

  <script>
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("loginModule");
  </script>

  <title>Page de login | <?= SITE_NAME ?></title>
</head>
<body>
<header>
  <?php include('./app/component/communs/Navbar.php') ?>
</header>

<main ng-controller="loginController">
  {{ login }}
  <div>
    <div>
      Inscription
      <form action="proc?add=user" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="passwword">
        <input type="submit" value="Inscription">
      </form>
    </div>
    <div>
      Connexion
      <form ng-submit="addUser()" class="">
        <div>
          <input type="text" name="username" placeholder="Nom d'utilisateur"
                 class="py-1 px-3 rounded-full focus:outline-none" ng-model="inputs.username">
          <input type="password" name="password" placeholder="Mot de passe"
                 class="py-1 px-3 rounded-full focus:outline-none" ng-model="inputs.password">
          <input type="submit" value="Connexion" class="bg-gray-100 py-1 px-3 rounded-full">
        </div>
      </form>
    </div>
  </div>
</main>
<footer>

</footer>
</body>
</html>

