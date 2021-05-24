var templateModule = angular.module('templateModule', [])

templateModule.controller('templateController', ($scope) => {
    
    $scope.testUnitaire = "template page";
    
    $scope._onInit = () => {
        console.log('shop')
    }
    
})

angular.module("rootApp").requires.push("templateModule");
