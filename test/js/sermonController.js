var sermonApp = angular.module('sermonApp', []);

sermonApp.controller('sermonController',MyCtrl);

function MyCtrl($scope, $http, $timeout) {
   		$http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = data;
       });
      
   }
