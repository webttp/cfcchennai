var homeApp = angular.module('homeApp', []);

homeApp.controller('imageController', function ($scope, $http, $timeout,$location) {
	$http.get('admin/getImages.php').success(function(data){
		$scope.loaded = true;
		$scope.images = data;
    $scope.totalItems = $scope.images.length;
    });
	$scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
	$scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});
