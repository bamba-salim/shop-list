let webServiceModule = angular.module("webServiceModule", [])

webServiceModule.service("ws", function ($http){
    this.get = (url, config = null) =>  $http.get(`${location.pathname}api/${url}`, config)

    this.post = (url, params, config =null) => $http.post(`${location.pathname}api/${url}`, params, config)
})