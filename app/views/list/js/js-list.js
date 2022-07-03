let listModule = angular.module("listModule", ["webServiceModule", "ui.router", "ui.bootstrap"])

listModule.service("listService", function ($http, ws) {
    this.getList = (idList) => ws.get("fetch-list/" + idList)

    this.saveItem = (itemFormBean, list) => {
        itemFormBean.list = list
        return ws.post("save-new-item-list", {itemFormBean: itemFormBean})
    }

    this.deleteItem = (idsItem) => {
        return ws.post("delete-item-list", {idsItem: idsItem})
    }
})


listModule.controller("listController", function ($scope, $state, listService, $stateParams) {

    $scope.test = "ça fonctionne test"
    $scope.userLists = []

    $scope.inputs = {}

    $scope.list = {}
    $scope.listInfo = {
        highet : {},
        lowest: {},
        price: 0,
        quantity: 0,
        moy: 0
    }
    $scope.itemsList = []
    $scope.selectedItems = []

    $scope._onListInit = () => {
        if (!$scope.isConnected) $state.go("home")
        getListData();

    }

    $scope.submitCreateItem = () => {
        listService.saveItem($scope.inputs, $stateParams.id).then(res => {
        }).finally(() => {
            getListData()
            $scope.inputs = {}
        })
    }

    $scope.sumbitDeleteItem = idItem => {
        $scope.selectedItems.push(idItem)
        $scope.submitMutipleDeleteItems()
    }

    $scope.submitMutipleDeleteItems = ()  => {
        listService.deleteItem($scope.selectedItems).then(res =>
            console.log(res)
        ).finally(() => {
            $scope.selectedItems = []
            getListData()
        })
    }

    $scope.contains = (value, array) => contains(value, array)

    $scope.switchSelectedItems = (idList) => {
        let selected = $scope.selectedItems
        if (!_.includes(selected, idList)) {
            selected.push(idList)
        } else {
            let indexList = selected.indexOf(idList)
            selected.splice(indexList, 1)
        }
        $scope.selectedItems = selected
    }

    function getListData() {
        listService.getList($stateParams.id).then(res => {
            $scope.list = res.data.list
            $scope.itemsList = res.data.itemsList
            $scope.listInfos = res.data.listInfos;
            initInfoCalcule($scope.itemsList)
        })


    }
    function initInfoCalcule(itemsList){
        $scope.listInfo = {
            highest : _.maxBy(itemsList, item => item.price),
            lowest: _.minBy(itemsList, item => item.price),
            price: _.sumBy(itemsList, item => (item.price * item.quantity)),
            quantity: _.sumBy(itemsList, item => item.quantity),
            moy: _.sumBy(itemsList, item => (item.price * item.quantity)) / _.sumBy(itemsList, item => item.quantity)
        }


    }

    function contains(value, array) {
        return _.includes(array, value)
    }
})


angular.module("rootApp").requires.push("listModule")