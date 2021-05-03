var loginModule = angular.module('loginModule', [])

loginModule.service('loginService', function ($http) {
  this.logUser = (data) => {
    return $http.post("./proc?log=user", {"user": data})
  }
})

loginModule.controller('loginController', ($scope, $http, loginService) => {
  $scope.inputs = {}
  $scope.login = 'page de login'
  
  $scope.addUser = () => {
    loginService.logUser($scope.inputs).then(res => {
      if(res.data.response === 'success'){
        console.log(res.data.data);
      } else {
        console.log(res.data.message);
      }
      
    })
  }
  
})
