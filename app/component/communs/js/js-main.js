function _log_redirect() {
  if (!_.isNull(localStorage.getItem('u_t'))) {
    window.location.href = './'
  }
}

function _unlog_redirect() {
  if (_.isNull(localStorage.getItem('u_t'))) {
    window.location.href = './login'
  }
}

var app = angular.module("rootApp", [])

app.controller('main', ($scope)=>{
  $scope.SITE_NAME = 'SHOP LIST';
  $scope.CSS_CLASS = {
    BTN : 'border shadow-sm font-medium py-3 px-5 my-1'
  }
  
})

