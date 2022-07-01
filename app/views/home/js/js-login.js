"use strict"

import Auth from "../../../src/service/auth.js";
import Regex from "../../../src/modules/regex.js";

let loginAppModule = angular.module('loginAppModule', ["webServiceModule", "ui.router"])

loginAppModule.service("loginAppService", function (ws) {

    // sign in
    this.signIn = (loginFormBean) => ws.post("sign-in-user", {loginFormBean: loginFormBean})

    // sign up
    this.signUp = (userFormBean) => ws.post("sign-up-new-user", {userFormBean: userFormBean})

    this.isValidUsernameCheck = (username) => ws.get(`check-valid-username/${username}`)

})

loginAppModule.controller("loginAppController", function ($scope, loginAppService, $state) {

    $scope.form = {}
    $scope.isSignIn = true;
    $scope.inputs = {}
    $scope.validUsername = false
    $scope.validUsernameMessage = ""

    $scope._loginInit = () => {
        if($scope.isConnected) $state.go("dashboard")
    }

    $scope.switchLogin = () => $scope.isSignIn = !$scope.isSignIn;

    $scope.signinSubmit = () => {
        loginAppService.signIn($scope.inputs).then(res => {
            if (res.data.user ){
                Auth.setUserSession(res.data.user)
            } else {
                console.log(res)
            }
        })
    }

    $scope.signupSubmit = () => {
        loginAppService.signUp($scope.inputs).then(res => {
            if (res.data.user ){
                Auth.setUserSession(res.data.user)
            } else {
                console.log(res)
            }
        })
    }

    $scope.checkValidUsername = username => {
        if(username !== undefined && username.length > 4 ){
            loginAppService.isValidUsernameCheck(username).then(res => {
                $scope.validUsername = res.data.isValid && Regex.USERNAME.test(username)
                $scope.validUsernameMessage = `"${username}" ${$scope.validUsername ? " est disponible !" : " n'est pas disponible ! Ce compte vous appartiens ?"} `;
            })
        }

    }

})

angular.module("rootApp").requires.push("loginAppModule")