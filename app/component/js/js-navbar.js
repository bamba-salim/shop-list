var navbarModule = angular.module('navbarModule', [])

navbarModule.service('navbarService', function () {

})

navbarModule.controller('navbarController', ($scope, navbarService) => {
  $scope.navbar = 'la nav bar'
  
  $scope._logout = () => {
    console.log('logout')
  }
})


angular.module("rootApp").requires.push("navbarModule");
