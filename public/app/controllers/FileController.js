
onlineftp.controller('FileController', function ($scope, $http, File) {
    // $scope.files = File.query();
    $http.get('dir/').success(function(data) {
        $scope.files = data.content;
    });
});