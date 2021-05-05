<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>
  <script type="text/javascript" src="./app/component/js/js-login.js?vr=8"></script>
  <script>
    _log_redirect();
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("loginModule");
  </script>

  <title>Page de login | <?= SITE_NAME ?></title>
</head>
<body class="bg-gradient-to-r from-gray-500 to-gray-400 flex items-center">
<main ng-controller="loginController" class="mx-auto">

  <div class="min-h-2/3 bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg sm:max-w-prose mx-auto">
    <div class="flex flex-row w-full">
      <div class="w-1/2 rounded-tl-lg text-center p-3 text-2xl" ng-class="_inscription.class" ng-click="_sinscrire()">
        Inscription
      </div>
      <div class="w-1/2 rounded-tr-lg text-center p-3 text-2xl" ng-class="_connexion.class" ng-click="_seconnecter()">
        Connexion
      </div>
    </div>
    <div class="px-3 py-2">
      <!-- Inscription -->
      <div ng-show="_inscription.active">

        <form name="newForm" ng-submit="logUser(true)">
          <div class="my-2">
            <label for="newUsername">Identifiant</label>
            <input type="text" name="newUsername" id="newUsername" placeholder="Identifiant" ng-model="inputs.newUsername" ng-class="form_input_class" required />
          </div>
          <div class="my-2">
            <label for="newPassword">Mot de passe</label>
            <input type="password" name="newPassword" id="newPassword" placeholder="Mot de passe" ng-model="inputs.newPassword" ng-class="form_input_class" required />
          </div>
          <div class="my-2">
            <label for="password2">Confirmation mot de passe</label>
            <input type="password" name="password2" id="password2" placeholder="Confirmation mot de passe" ng-model="inputs.password2" ng-class="form_input_class" required />
          </div>
          <input type="submit" value="Inscription"
                 class="bg-green-600 text-white py-1 px-3 my-1 border w-full cursor-pointer" />
        </form>
      </div>
      <!-- Connexion -->
      <div class="" ng-show="_connexion.active">
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
              <input type="submit" value="Connexion"
                     class="bg-blue-800 text-white  py-1 px-3 my-1 border w-full cursor-pointer">
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

