var loginModule = angular.module('loginModule', [])
let active_log = "cursor-default bg-blue-800 text-white";
let inactive_log = 'cursor-pointer bg-gray-500 text-white';

loginModule.service('loginService', function ($http) {
  this._logUser = (data) => {
    return $http.post("./_.proc?log=user", {"user": data})
  }
  this._addUser = (data) => {
    return $http.post("./_.proc?add=user", {"user": data})
  }
})

loginModule.controller('loginController', ($scope, loginService) => {
  $scope.inputs = {};
  $scope.log_error = null;
  $scope.form_input_class = 'w-full py-1 px-3 my-1 border focus:outline-none';
  
  $scope._inscription = {
    active: true,
    class: active_log
  }
  
  $scope._connexion = {
    active: false,
    class: inactive_log
  }
  
  $scope._sinscrire = () => {
    $scope._inscription.active = true;
    $scope._inscription.class = active_log;
    $scope._connexion.active = false;
    $scope._connexion.class = inactive_log;
  }
  
  $scope._seconnecter = () => {
    $scope._connexion.active = true;
    $scope._connexion.class = active_log;
    $scope._inscription.active = false;
    $scope._inscription.class = inactive_log;
  }
  
  $scope.logUser = (newUser = false) => {
    if (newUser) {
      if($scope.inputs.newPassword === $scope.inputs.password2){
        loginService._addUser($scope.inputs).then(res => {
          if (res.data.response === 'success') {
            localStorage.setItem('u_t', res.data.data.token);
            window.location.href = './';
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
          localStorage.setItem('u_t', res.data.data.token);
          window.location.href = './';
        } else {
          $scope.log_error = res.data.message;
        }
      })
    }
  }
  
})
angular.module("rootApp").requires.push("loginModule");
