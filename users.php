<html lang="fr" ng-app="rootApp" ng-controller="main">
<head>
  <?php include_once('./app/component/communs/header.php') ?>

  <script type="text/javascript" src="./app/component/js/js-users.js?vr=7"></script>

  <title>Gestion utilisateurs | {{SITE_NAME}} </title>
</head>
<body class="bg-gray-50">
<?php include('./app/component/communs/Navbar.php') ?>

<main ng-controller="usersController" ng-init="_onInit()">
  <div class="bg-white shadow-lg px-3 py-5">
    <div class="w-11/12 mx-auto">
      <h1 class="font-bold text-3xl	">Gestion utilisateurs</h1>
    </div>
  </div>
  <div class="<?= CSS::BLOC ?>">
    <table class="table-auto w-full">
      <thead>
      <tr class="border-b-2 border-gray-500 p-3">
        <th class="text-left p-3">Username</th>
        <th class="text-left p-3">Listes</th>
        <th class="text-left p-3">Status</th>
        <th class="text-left p-3">Date d'inscription</th>
        <th class="text-right p-3">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="user in users" class="p-3" ng-class="user.class">
        <td class="text-left p-3">{{ user.username }}</td>
        <td class="text-left p-3">#listes</td>
        <td class="text-left p-3">{{ user.status_name }}</td>
        <td class="text-left p-3">{{ format_date(user.created_at) }}</td>
        <td class="text-right p-3">
          <a href="" ng-click="viewUserModal(user)"><?= ICON::VIEW ?></a>
          <a href="" ng-click="deleteUserModal(user)"><?= ICON::DELETE ?></a>
          <a href="" ng-click="switchUserActive(user.id)"><?= ICON::_ICON('{{user.toggleBtn}}', '{{user.toggleBtnClass}}') ?></a>
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
