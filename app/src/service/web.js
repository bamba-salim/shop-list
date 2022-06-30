let webServiceModule = angular.module("webServiceModule", [])

webServiceModule.service("ws", function ($http){
    this.get = (url, config = null) => $http.get(`./api/?url=${url}`, config)

    this.post = (url, params, config =null) => $http.post(`./api/?url=${url}`, params, config)
})