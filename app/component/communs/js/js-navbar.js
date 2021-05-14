var navbarModule = angular.module('navbarModule', [])

navbarModule.service('navbarService', function () {

})

navbarModule.controller('navbarController', ($scope, navbarService) => {
  $scope.navbar = 'la nav bar'
  $scope.isLog = !_.isNull(localStorage.getItem('u_t'));
  
  
  $scope._onInit = () => {
  
  }
  $scope._logout = () => {
    localStorage.removeItem('u_t');
    window.location.href = './login';
  }
})


angular.module("rootApp").requires.push("navbarModule");
