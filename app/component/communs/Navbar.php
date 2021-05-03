<script src="./app/component/js/js-navbar.js?vr=4" type="text/javascript"></script>

<header ng-controller="navbarController">
  <nav class="bg-gray-300  p-0 p-2" ng-init="_onInit()">
    <div>
      {{ navbar }}
    </div>
      <button class="bg-gray-100 py-1 px-3 rounded-full focus:outline-none" ng-click="_logout()">
        Se déconnecter
      </button>
  </nav>
</header>

