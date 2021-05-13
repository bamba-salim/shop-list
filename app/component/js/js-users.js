var usersModule = angular.module('usersModule', ["ui.bootstrap"])
let pair_class = "bg-gray-50";
let impair_class = "bg-gray-100"

usersModule.service('usersService', function ($http) {
    this._fetchAllUsers = () => {
        return $http.get('./proc?fetch=users')
    }
    
    this._switchActiveUser = (idUser) => {
        return $http.post('./proc?set=user-active', {'id': idUser})
    }
})

usersModule.controller('usersController', ($scope, usersService, $uibModal) => {
    $scope.users = []
    
    $scope._onInit = () => {
        fetchAllUsers()
    }
    
    $scope.onDeleteUserCLick = (idUser) => {
        console.log('delete: ' + idUser)
    }
    
    $scope.onOpenUserViewModalCLick = (idUser) => {
        console.log('view: ' + idUser)
    }
    
    $scope.onToggleActiveClick = (idUser) => {
        usersService._switchActiveUser(idUser)
            .then(fetchAllUsers());
    }
    $scope.format_date = (date) => {
        return dayjs(date).format('MMM DD, YYYY');
    }
    
    
    function isOdd(num) {
        return num % 2;
    }
    
    function fetchAllUsers() {
        usersService._fetchAllUsers()
            .then(res => {
                $scope.users = res.data.data
                _.forEach($scope.users, (user, i) => {
                    user.toggleBtn = user.active === '1' ? 'toggle_on' : 'toggle_off';
                    user.toggleBtnClass = user.active === '1' ? 'text-green-600' : 'text-red-600';
                    $scope.users[i].class = isOdd(i) === 0 ? pair_class : impair_class;
                })
            })
    }
    
})

angular.module("rootApp").requires.push("usersModule");
