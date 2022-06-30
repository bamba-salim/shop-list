let dashboardModule = angular.module("dashboardModule", ["webServiceModule", "ui.router"])

dashboardModule.service("dashboardService", function ($http, ws) {
    this.fetchUserLists = (userID) => ws.get("fetch-user-list/" + userID)

    this.saveList = (listFormBean, user) => {
        listFormBean.user = user
        return ws.post("save-new-list", {listFormBean: listFormBean});
    }

    this.deleteList = idsList => {
        return ws.post("delete-lists", {idsList: idsList})
    }


})

dashboardModule.controller("dashboardController", function ($scope, $state, dashboardService) {

    $scope.inputs = {}
    $scope.userLists = []
    $scope.selectedLists = []

    $scope._onDashboardInit = () => {
        if (!$scope.isConnected) $state.go("home");
        getUserLists()
    }

    $scope.submitCreateList = () => {
        dashboardService.saveList($scope.inputs, $scope.sessionUser.id).then(res => {
        }).finally(() => {
            $scope.inputs = {}
            getUserLists()
        })
    }

    $scope.submitDeleteList = idList => {
        $scope.selectedLists.push(idList)
        $scope.submitMutipleDeleteList()
    }

    $scope.submitMutipleDeleteList = () => {
        dashboardService.deleteList($scope.selectedLists).then(res => {
            console.log(res)
        }).finally(() => {
            $scope.selectedLists = []
            getUserLists()
        })
    }

    $scope.contains = (value, array) => contains(value, array)

    $scope.switchSelectedList = (idList) => {
        let selected = $scope.selectedLists
        if (!_.includes(selected, idList)) {
            selected.push(idList)
        } else {
            let indexList = selected.indexOf(idList)
            selected.splice(indexList, 1)
        }
        $scope.selectedLists = selected
    }

    function getUserLists() {
        dashboardService.fetchUserLists($scope.sessionUser.id).then(res => {
            $scope.userLists = res.data.userLists
        })
    }

    function contains(value, array) {
        return _.includes(array, value)
    }

})

dashboardModule.directive("viewList", function ($state) {
    return {
        restrict: 'A',
        scope: {
            idList: "<"
        },
        link: function (scope, element) {
            let idList = scope.idList;


            $(element).click(() => {
                $state.go('list', {id: idList})
            })
        }
    }
})

angular.module("rootApp").requires.push("dashboardModule")