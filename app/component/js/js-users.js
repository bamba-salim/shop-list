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
    console.log(idUser);
    usersService._switchActiveUser(idUser)
      .then(res => {
        console.log(res)
        fetchAllUsers();
      });
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
          if (user.active === "1") {
            user.toggleBtn = "toggle_on"
            user.toggleBtnClass = "text-green-600"
          } else {
            user.toggleBtn = "toggle_off"
            user.toggleBtnClass = "text-red-600"
          }
          if (isOdd(i) === 0) {
            $scope.users[i].class = pair_class;
          } else {
            $scope.users[i].class = impair_class;
          }
          
        })
      })
  }
  
})

