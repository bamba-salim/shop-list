var loginModule = angular.module('loginModule', [])

loginModule.service('loginService', function ($http) {
  this._logUser = (data) => {
    return $http.post("./proc?log=user", {"user": data})
  }
  this._addUser = (data) => {
    return $http.post("./proc?add=user", {"user": data})
  }
})

loginModule.controller('loginController', ($scope, $http, loginService) => {
  $scope.inputs = {};
  $scope.log_error = null;
  $scope.form_input_class = 'w-full py-1 px-3 my-1 border focus:outline-none';
  
  
  $scope.logUser = (newUser = false) => {
    console.log('log');
    if (newUser) {
      loginService._addUser($scope.inputs).then(res => {
        if (res.data.response === 'success') {
          localStorage.setItem('u_t', res.data.data.token);
          window.location.href = './';
        } else {
          $scope.log_error = res.data.message;
        }
      })
    } else {
      loginService._logUser($scope.inputs).then(res => {
        console.log(res.data)
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
