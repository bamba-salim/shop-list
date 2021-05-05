<?php require_once('./resources/config.php') ?>

<html ng-app="rootApp" lang="fr">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-users.js?vr=3"></script>

  <script>
    angular.module("rootApp", []);
    angular.module("rootApp").requires.push("usersModule");
  </script>

  <title>Gestion utilisateurs | <?= SITE_NAME ?></title>
</head>
<body class="bg-gray-50">
<?php include('./app/component/communs/Navbar.php') ?>

<main ng-controller="usersController" ng-init="_onInit()">
  <div class="bg-white shadow-lg px-3 py-5">
    <div class="w-11/12 mx-auto">
      <h1 class="font-bold text-3xl	">Gestion utilisateurs</h1>
    </div>
  </div>
  <div class="mx-auto w-11/12 shadow-lg bg-white m-5 py-5">
    <table class="table-fixed w-full">
      <thead>
      <tr class="border-b-2 border-gray-500 p-3">
        <th class="w-1/3 text-left p-3">Username</th>
        <th class="w-1/3 text-left p-3">Status</th>
        <th class="w-1/3 text-left p-3">Date d'inscription</th>
        <th class="w-1/3 text-right p-3">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="user in users" class="p-3" ng-class="user.class">
        <td class="w-5/12 text-left p-3">{{ user.username }}</td>
        <td class="w-5/12 text-left p-3">{{ user.status_name }}</td>
        
        <td class="w-5/12 text-left p-3">{{ user.created_at }}</td>
        <td class="w-2/12 text-right p-3">
          <a href="" ng-click="onOpenUserViewModalCLick(user.id)"><span class="material-icons">visibility</span></a>
          <a href="" ng-click="onDeleteUserCLick(user.id)" ><span class="material-icons">delete</span></a>
          <a href="" ng-click="onToggleActiveClick(user.id)" ><span class="material-icons" ng-class="user.toggleBtnClass">{{user.toggleBtn}}</span></a>
          {{ user.id }}
        </td>
      </tr>

      </tbody>
    </table>

  </div>

</main>
<footer>

</footer>
</body>
</html>
