var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter', '720kb.datepicker']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   // setting the number of records per page
   $scope.messages = [];
   $http.get('admin/getMessages.php?action=start').success(function(data){
   		$scope.loaded = true;
   		$scope.messages = data;
   		$scope.pageLimit = 5; // setting the number of records per page
   });
   
   $scope.locationtrigger = function(place) {
			$http.get('admin/getMessages.php?action='+'locate&'+'location='+place).success(function(data){
			$scope.messages = data;
			$scope.pageLimit = 5; // setting the number of records per page
	});
   }
   $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    
    $scope.showData = function( ){

	 $scope.curPage = 0;
 	$scope.pageSize = 5;
 
  	$scope.numberOfPages = function() {
				return Math.ceil($scope.messages.length / $scope.pageSize);
	};
    }
});

angular.module('sermonApp').filter('pagination', function()
{
  return function(input, start) {
    start = parseInt(start, 10);
    return input.slice(start);
  };
});
