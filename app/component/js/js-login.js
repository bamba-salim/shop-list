var loginModule = angular.module('loginModule', [])
let active_log = "cursor-default bg-blue-800 text-white";
let inactive_log = 'cursor-pointer bg-gray-500 text-white';

loginModule.service('loginService', function ($http) {
    this._logUser = (data) => {
        return $http.post("./_api?log=user", {"user": data})
    }
    this._addUser = (data) => {
        return $http.post("./_api?add=user", {"user": data})
    }
})

loginModule.controller('loginController', ($scope, loginService) => {
    $scope.inputs = {};
    $scope.log_error = null;
    $scope.form_input_class = 'w-full py-1 px-3 my-1 border focus:outline-none';
    $scope.isNew = true;
    $scope.submitButton = "S'inscrire"
    $scope._inscription = {active: true, class: active_log}
    $scope._connexion = {active: false, class: inactive_log}
    
    $scope._sinscrire = () => {
        $scope.isNew = true;
        $scope.submitButton = "S'inscrire"
        $scope._inscription = {active: true, class: active_log}
        $scope._connexion = {active: false, class: inactive_log}
    }
    
    $scope._seconnecter = () => {
        $scope.isNew = false;
        $scope.submitButton = "Se Connecter";
        $scope._connexion = {active: true, class: active_log}
        $scope._inscription = {active: false, class: inactive_log}
    }
    
    $scope.logUser = (newUser = false) => {
        if ($scope.isNew) {
            if ($scope.inputs.password === $scope.inputs.password2) {
                loginService._addUser($scope.inputs).then(res => {
                    if (res.data.response === 'success') {
                        redirect_after_log(res.data.data.token)
                    } else {
                        $scope.log_error = res.data.message;
                    }
                })
            } else {
                $scope.log_error = "Les mots de passe ne correspondent pas!"
            }
        } else {
            loginService._logUser($scope.inputs).then(res => {
                if (res.data.response === 'success') {
                    redirect_after_log(res.data.data.token)
                } else {
                    $scope.log_error = res.data.message;
                }
            })
        }
    }
    
    function redirect_after_log(token) {
        localStorage.setItem('u_t', token);
        window.location.href = './';
    }
    
})
angular.module("rootApp").requires.push("loginModule");
