'use strict';

/* Services */

var usersServices = angular.module('usersServices', ['ngResource']);

usersServices.factory('Log', ['$resource',
    function ($resource) {
        return $resource("auth/log", {}, {
            get: {method: 'GET'}
        });
    }]);

usersServices.factory('Login', ['$resource',
    function ($resource) {
        return $resource("auth/login", {}, {
            save: {method: 'POST'}
        });
    }]);

usersServices.factory('Logout', ['$resource',
    function ($resource) {
        return $resource("auth/logout", {}, {
            get: {method: 'GET'}
        });
    }]);

usersServices.factory('Dream', ['$resource',
    function ($resource) {
        return $resource("dream/:id", {page: '@page'}, {
            get: {method: 'GET'},
            save: {method: 'POST'},
            delete: {method: 'DELETE'},
            update: {method: 'PUT'}
        });
    }]);
	
usersServices.factory('User', ['$resource',
    function ($resource) {
        return $resource("user/:id", {page: '@page'}, {
            get: {method: 'GET'},
            save: {method: 'POST'},
            delete: {method: 'DELETE'},
            update: {method: 'PUT'}
        });
    }]);




