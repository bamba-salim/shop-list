<script src="./app/component/js/js-navbar.js?vr=6" type="text/javascript"></script>

<header ng-controller="navbarController" ng-init="_onInit()">
  <nav class="bg-gray-300 p-5 flex flex-row">
    <div>
      {{ navbar }}
    </div>
    <div ng-show="isLog">
      <span class="" ng-click="_logout()" >
        <span class="material-icons text-red-600">input</span>
      </span>
    </div>

  </nav>
</header>
