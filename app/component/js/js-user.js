var userModule = angular.module('userModule', [])

userModule.service('userService', function ($http) {
    
    this.fetchUser = (user_token) => {
        return $http.get('./_.proc?fetch=user&token=' + user_token);
    }
    
})

userModule.controller('userController', ($scope, userService) => {
    $scope.user = {};
    
    $scope._onInit = (userToken) => {
        fetch_user_by_token(userToken !== '' ? userToken : localStorage.getItem('u_t'))
    }
    
    function fetch_user_by_token(token) {
        userService.fetchUser(token)
            .then(res => {
                $scope.user = res.data.data[0];
            })
            .catch(err => console.log(err))
    }
    
})

angular.module("rootApp").requires.push("userModule");
