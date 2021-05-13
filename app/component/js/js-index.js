var shopModule = angular.module('shopModule', [])

shopModule.controller('shopController', ($scope) => {
  
  $scope.testUnitaire = "variable a tester";

  $scope._onInit = () => {
    console.log('shop')
  }
})

angular.module("rootApp").requires.push("shopModule");
