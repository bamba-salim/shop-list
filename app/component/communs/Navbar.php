<script src="./app/component/communs/js/js-navbar.js?vr=6" type="text/javascript"></script>

<header ng-controller="navbarController" ng-init="_onInit()">
  <nav class="bg-gray-300 p-5 flex flex-row right-0">
    <a class="" href="./">
      {{ navbar }}
    </a>
    <div ng-show="isLog" class="right-0">

      <a href="./user" class="cursor-pointer"><?= ICON::USER ?></a>
      <a href="./users" class="cursor-pointer"><?= ICON::USERS ?></a>
      <span class="cursor-pointer text-red-600" ng-click="_logout()"><?= ICON::LOGOUT ?></span>
    </div>

  </nav>
</header>
