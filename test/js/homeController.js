 var myApp = angular.module('myApp', []);
 
 myApp.controller('MyCtrl',['$scope','$http','$timeout',myController]);
 
 function myController($scope, $http, $timeout){
 	$http.get('/admin/getImages.php').success(function(data){
		$scope.items = data;
 	});
 }

