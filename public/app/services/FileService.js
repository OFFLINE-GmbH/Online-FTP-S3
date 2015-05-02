var fileServices = angular.module('fileServices', ['ngResource']);

fileServices.factory('File', ['$resource', function ($resource) {
    return $resource('files/:fileId.json', {}, {
        query: {method: 'GET', params: {phoneId: 'phones'}, isArray: true}
    });
}]);