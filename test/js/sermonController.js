var sermonApp = angular.module('sermonApp', []);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   $http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = data;
   });
   $scope.locationItems = [
      {  id: 1,
         location: 'CFC-Tambaram'},
      {  id: 2,
         location: 'CFC-Thirumullaivoyal' }
      ]
});

