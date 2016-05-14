var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   $http.get('admin/messagesData.json').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = data;
   });
   
});

