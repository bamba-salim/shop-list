<?php
  require_once('./resources/config.php');
  require_once('./resources/controllers/UserController.php');
  require_once('./resources/models/UserModel.php');
  
  $model = new UserModel();
  
  $test = "test";
  $test1 = "autre chose";
  
  $hash = $model->pass_crypt($test1);
  var_dump($_SESSION['token']);
  
?>

<html lang="fr">
<head>

  <?php include_once('./app/component/communs/header.php') ?>
  <title><?= SITE_NAME ?></title>

  <script src="./app/assets/js/js-angular.js" type="text/javascript"></script>
  <link rel="stylesheet" href="./app/assets/style/tailwind.css">
</head>
<body>
<nav>
  <form action="proc?log=user" method="post" ng-show="<?= isset($_SESSION['token']) ?>">
    <input type="text" name="username" placeholder="Nom d'utilisateur" class="p-1 ounded-full">
    <input type="password" name="password" placeholder="passwword" class="p-1 rounded-full">
    <input type="submit" value="Connexion">
  </form>
</nav>*
<!-- form pour la connexipon -->


<?php include_once('./app/component/communs/footer.php') ?>

