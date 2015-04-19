
onlineftp.controller('FileController', function ($scope, $http, File) {
    // $scope.files = File.query();
    $http.get('app/dummydata/files.json').success(function(data) {
        $scope.files = data;
    });
});