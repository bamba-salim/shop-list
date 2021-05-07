<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>
  <script type="text/javascript" src="./app/component/js/js-login.js?vr=9"></script>
  <script>
    _log_redirect();
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("loginModule");
  </script>

  <title>Page de login | <?= SITE_NAME ?></title>
</head>
<body class="bg-gradient-to-r from-gray-500 to-gray-400 flex items-center">
<main ng-controller="loginController" class="mx-auto w-10/12  md:w-2/3 lg:w-1/4 h-1/2">

  <div class="bg-gradient-to-b from-gray-100 to-gray-200 rounded-lg min-h-full bg-opacity-75">
    <div class="flex flex-row w-full">
      <div class="<?= CSS::LOGIN_SWITCHED_BTN ?> rounded-tl-lg" ng-class="_inscription.class" ng-click="_sinscrire()">
        <p>Inscription</p>
      </div>
      <div class="<?= CSS::LOGIN_SWITCHED_BTN ?> rounded-tr-lg" ng-class="_connexion.class" ng-click="_seconnecter()">
        <p>Connexion</p>
      </div>
    </div>
    <div class="px-3 py-2 min-w-full">
      <!-- Inscription -->
      <div ng-show="_inscription.active">

        <form name="newForm" ng-submit="logUser(true)">
          <div class="my-2">
            <label for="newUsername">Identifiant</label>
            <input type="text" name="newUsername" id="newUsername" placeholder="Identifiant"
                   ng-model="inputs.newUsername" class="<?= CSS::FORM_INPUT_CLASS ?>" required/>
          </div>
          <div class="my-2">
            <label for="newPassword">Mot de passe</label>
            <input type="password" name="newPassword" id="newPassword" placeholder="Mot de passe"
                   ng-model="inputs.newPassword" class="<?= CSS::FORM_INPUT_CLASS ?>" required/>
          </div>
          <div class="my-2">
            <label for="password2">Confirmation mot de passe</label>
            <input type="password" name="password2" id="password2" placeholder="Confirmation mot de passe"
                   ng-model="inputs.password2" class="<?= CSS::FORM_INPUT_CLASS ?>" required/>
          </div>
          <div class="my-2">
            <input type="submit" value="Inscription" class="<?= CSS::FORM_INPUT_BTN ?>"/>
          </div>
        </form>
      </div>
      <!-- Connexion -->
      <div ng-show="_connexion.active">
        <form name="form" ng-submit="logUser()">
          <div class="my-2">
            <label for="username">Identifiant</label>
            <input type="text" name="username" id="username" placeholder="Identifiant"
                   ng-model="inputs.username" class="<?= CSS::FORM_INPUT_CLASS ?>" required>
          </div>
          <div class="my-2">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe"
                   ng-model="inputs.password" class="<?= CSS::FORM_INPUT_CLASS ?>" required>
          </div>
          <div class="my-2">
            <input type="submit" value="Connexion" class="<?= CSS::FORM_INPUT_BTN ?>">
          </div>
        </form>
      </div>
      <!-- error message -->
      <div ng-show="!_.isNull(log_error)">
        <p class="text-red-500">{{ log_error }}</p>
      </div>
    </div>
  </div>
</main>
</body>
</html>

