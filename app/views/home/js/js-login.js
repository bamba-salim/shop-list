"use strict"

import Auth from "../../../src/service/auth.js";

let loginAppModule = angular.module('loginAppModule', ["webServiceModule", "ui.router"])

loginAppModule.service("loginAppService", function (ws) {

    // sign in
    this.signIn = (loginFormBean) => ws.post("sing-in-user", {loginFormBean: loginFormBean})

    // sign up
    this.signUp = (userFormBean) => ws.post("sign-up-new-user", {userFormBean: userFormBean})

})

loginAppModule.controller("loginAppController", function ($scope, loginAppService, $state) {

    $scope.form = {}
    $scope.isSignIn = true;
    $scope.inputs = {}

    $scope._loginInit = () => {
        if($scope.isConnected) $state.go("dashboard")
    }

    $scope.switchLogin = () => $scope.isSignIn = !$scope.isSignIn;

    $scope.signinSubmit = () => {
        loginAppService.signIn($scope.inputs).then(res => Auth.setUserSession(res.data.user))
    }

    $scope.signupSubmit = () => {
        loginAppService.signUp($scope.inputs).then(res => Auth.setUserSession(res.data.user))
    }
})

angular.module("rootApp").requires.push("loginAppModule")