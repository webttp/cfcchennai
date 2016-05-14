var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   $http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = data;
   });
   
   $scope.locationtrigger = function(place) {
			$http.get('admin/getMessages.php?action='+'locate&'+'location='+place).success(function(data){
			$scope.messages = data;
	});
   }
   $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
});

