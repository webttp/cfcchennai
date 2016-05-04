 var homeApp = angular.module('myApp', []).controller('MyCtrl',MyCtrl);
 function MyCtrl($scope, $http, $timeout) {
		$http.get('/admin/getImages.php').success(function(data){
		$scope.items = data;
    });
}
