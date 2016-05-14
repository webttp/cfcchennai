var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   var messagesObj;
   $http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		messagesObj = data;
   });
   $scope.messageObject = Object.keys(messagesObj).map(function(key) {
    return myObj[key];
  });
});

