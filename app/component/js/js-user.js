var userModule = angular.module('userModule', [])

userModule.service('userService', function ($http) {
  
  this.fetchUser = (user_token) => {
    return $http.get('./proc?fetch=user&token=' + user_token)
  }
  
})

userModule.controller('userController', ($scope, userService) => {
  
  $scope.user = {};
  
  $scope.testUnitaire = "user page";
  
  $scope._onInit = () => {
    fetch_user_by_token(localStorage.getItem('u_t'))
  }
  
  function fetch_user_by_token(token) {
    userService.fetchUser(token)
      .then(res => {
        $scope.user = res.data.data[0];
        console.log($scope.user);
      })
      .catch(err => console.log(err))
  }
  
})

