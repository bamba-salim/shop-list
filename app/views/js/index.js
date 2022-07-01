import Config from "../../src/config.js";
import CssClass from "../../src/modules/cssClass.js";
import Auth from "../../src/service/auth.js"

export const app = angular.module("appModule", ["ngRoute", "webServiceModule", "ui.router"])

app.config(function ($stateProvider, $locationProvider) {

    var homeState = {
        name: 'home',
        url: '/',
        templateUrl: `${base}/home/home-view.php?v=${filesVersion}`
    }

    var dashboardState = {
        name: 'dashboard',
        url: '/dashboard',
        templateUrl: `${base}/user/dashboard-view.php?v=${filesVersion}`
    }

    var listState = {
        name: 'list',
        url: '/list/{id}',
        templateUrl: `${base}/list/list-view.php?v=${filesVersion}`
    }

    var notFound = {
        name: 'notFound',
        url: '*path',
        template: "<h1>cette pas n'existe pas</h1>",
    }

    $stateProvider.state(notFound);
    $stateProvider.state(listState);
    $stateProvider.state(homeState);
    $stateProvider.state(dashboardState);
})

app.service("appService", function (ws) {

})

app.controller("appController", function ($scope, $location) {
    $scope.cssClass = CssClass;
    $scope.APP_NAME = Config.name

    $scope._appInit = () => {
        $scope.isConnected = Auth.IsLoggedIn
        $scope.sessionUser = Auth.User
    }

    $scope.submitSignOut = () => {
        Auth.removeUserSession();
    }
})

angular.module("rootApp").requires.push("appModule")

