 var homeApp = angular.module('myApp', ['ngRoute']).controller('MyCtrl',MyCtrl);
 function MyCtrl($scope, $http, $timeout) {
		$http.get('../admin/getImages.php').success(function(data){
		$scope.items = data;
    });
}
