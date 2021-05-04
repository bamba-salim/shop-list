<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>
  <script type="text/javascript" src="./app/component/js/js-login.js?vr=6"></script>
  <script>
    _log_redirect();
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("loginModule");
  </script>

  <title>Page de login | <?= SITE_NAME ?></title>
</head>
<body class="bg-gradient-to-r from-gray-500 to-gray-400 flex items-center">
<main ng-controller="loginController" class="mx-auto w-full">

  <div class="min-h-2/3 bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg sm:max-w-prose md:w-1/3 mx-auto">
    <div class="flex flex-row w-full">
      <div class="w-1/2 rounded-tl-lg border text-center p-3 text-2xl cursor-pointer">Inscription</div>
      <div class="w-1/2 rounded-tr-lg border text-center p-3 text-2xl cursor-default bg-blue-800 text-white">Connexion</div>
    </div>
    <div class="px-3 py-2">
      <!-- Inscription -->
      <div>
        Inscription
        <form name="newForm" ng-submit="logUser(true)">
          <div class="my-2">
            <label for="newUsername">Identifiant</label>
            <input type="text" name="newUsername" id="newUsername" placeholder="newUsername" ng-model="inputs.newUsername" ng-class="form_input_class" required>
          </div>
          <div class="my-2">
            <label for="newPassword">Mot de passe</label>
            <input type="password" name="newPassword" id="newPassword" placeholder="newPassword" ng-model="inputs.newPassword" ng-class="form_input_class" required>
          </div>
          <input type="submit" value="Inscription" class="bg-green-600 text-white py-1 px-3 my-1 border w-full">
        </form>
      </div>
      <!-- Connexion -->
      <div class="">
        Connexion
        <form name="form" ng-submit="logUser()" class="">
          <div>
            <div class="my-2">
              <label for="username">Identifiant</label>
              <input type="text" name="username" id="username" placeholder="Identifiant"
                     ng-class="form_input_class" ng-model="inputs.username" required>
            </div>
            <div class="my-2">
              <label for="password">Mot de passe</label>
              <input type="password" name="password" id="password" placeholder="Mot de passe"
                     ng-class="form_input_class" ng-model="inputs.password" required>
            </div>
            <div class="my-2">
              <input type="submit" value="Connexion" class="bg-blue-800 text-white  py-1 px-3 my-1 border w-full">
            </div>
          </div>
        </form>
      </div>
      <div ng-show="!_.isNull(log_error)">
        <p class="text-red-500">{{ log_error }}</p>
      </div>
    </div>
  </div>
</main>
</body>
</html>

