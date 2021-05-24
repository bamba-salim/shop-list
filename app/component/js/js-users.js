var usersModule = angular.module('usersModule', ["ui.bootstrap"])
let pair_class = "bg-gray-50";
let impair_class = "bg-gray-100"

usersModule.service('usersService', function ($http) {
    this._fetch_all_users = () => {
        return $http.get('./_api?fetch=users')
    }
    this._fecth_user = () => {
    
    }
    
    this._switch_active_user = (idUser) => {
        return $http.post('./_api?set=user-active', {'id': idUser})
    }
    
    this._delete_user = (id) => {
        return $http.post('./_api?del=user-id', {'id': id})
    }
})

usersModule.controller('usersController', ($scope, usersService, $uibModal) => {
    $scope.users = []
    
    $scope._onInit = () => {
        fetchAllUsers()
    }
    
    
    $scope.viewUser = (token) => {
        // todo: create modal
        window.location.href = './user?token=' + token;
    }
    
    $scope.switchUserActive = (idUser) => {
        usersService._switch_active_user(idUser).then(fetchAllUsers());
    }
    
    function isOdd(num) {
        return num % 2;
    }
    
    function fetchAllUsers() {
        usersService._fetch_all_users()
            .then(res => {
                $scope.users = res.data.data
                _.forEach($scope.users, (user, i) => {
                    user.toggleBtn = user.active === '1' ? 'toggle_on' : 'toggle_off';
                    user.toggleBtnClass = user.active === '1' ? 'text-green-600' : 'text-red-600';
                    $scope.users[i].class = isOdd(i) === 0 ? pair_class : impair_class;
                })
            })
    }
    
    //MODALS

// view user modals
    
    $scope.viewUserModal = (user) => {
        $uibModal.open({
            templateUrl: './app/component/modal/user-view-modal.php',
            appendTo: $("body"),
            resolve: {
                params: function () {
                    return {"user": user};
                }
            },
            controller: function ($uibModalInstance, $scope, params, usersService) {
                let btn_bg = 'red-600'
                let btn_hover_bg = 'red-700'
                let text_color = 'white'
                
                _.assignIn($scope, {
                    user: params.user,
                    modal: {
                        title: "Fiche Utilistaeur N° " + user.id,
                        text: 'Etes vous sur de vouloir supprimer définitivement l\'utilisateur "' + user.username + '" ?'
                    },
                    btn: {
                        title: "Supprimer",
                        class: 'bg-' + btn_bg + ' hover:bg-' + btn_hover_bg + ' text-' + text_color,
                    }
                })
                
                $scope.onEventButtonClick = () => {
                    usersService._delete_user($scope.user.id)
                    $scope.dismiss()
                }
                
                $scope.dismiss = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            }
        }).result.then(function (result) {
            console.log(result);
        }, function (message) {
            console.log("dismiss: " + message);
            fetchAllUsers()
        });
    }
    
    $scope.deleteUserModal = (user) => {
        $uibModal.open({
            templateUrl: './app/component/modal/template-confirmation-modal.php',
            appendTo: $("body"),
            resolve: {
                params: function () {
                    return {"user": user};
                }
            },
            controller: function ($uibModalInstance, $scope, params, usersService) {
                let btn_bg = 'red-600'
                let btn_hover_bg = 'red-700'
                let text_color = 'white'
                
                _.assignIn($scope, {
                    user: params.user,
                    modal: {
                        title: "Supprimer un utilisateur",
                        text: 'Etes vous sur de vouloir supprimer définitivement l\'utilisateur "' + user.username + '" ?'
                    },
                    btn: {
                        title: "Supprimer",
                        class: 'bg-' + btn_bg + ' hover:bg-' + btn_hover_bg + ' text-' + text_color,
                    }
                })
                
                $scope.onEventButtonClick = () => {
                    usersService._delete_user($scope.user.id)
                    $scope.dismiss()
                }
                
                $scope.dismiss = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            }
        }).result.then(function (result) {
            console.log(result);
        }, function (message) {
            console.log("dismiss: " + message);
            fetchAllUsers()
        });
    }
})

angular.module("rootApp").requires.push("usersModule");
