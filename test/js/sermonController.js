var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   $http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = JSON.stringify(data);
   });
   
});

