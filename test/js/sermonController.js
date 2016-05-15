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

	 $scope.itemsPerPage = 5;
	 $scope.currentPage = 0;
		
	 $scope.range = function() {
		var rangeSize = 4;
		var ps = [];
		var start;

		start = $scope.currentPage;
		if ( start > $scope.pageCount()-rangeSize ) {
		  start = $scope.pageCount()-rangeSize+1;
		}

		for (var i=start; i<start+rangeSize; i++) {
		  ps.push(i);
		}
		return ps;
	  };

	  $scope.prevPage = function() {
		if ($scope.currentPage > 0) {
		  $scope.currentPage--;
		}
	  };

	  $scope.DisablePrevPage = function() {
		return $scope.currentPage === 0 ? "disabled" : "";
	  };

	  $scope.pageCount = function() {
		return Math.ceil($scope.messages.length/$scope.itemsPerPage)-1;
	  };

	  $scope.nextPage = function() {
		if ($scope.currentPage < $scope.pageCount()) {
		  $scope.currentPage++;
		}
	  };

	  $scope.DisableNextPage = function() {
		return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
	  };

	  $scope.setPage = function(n) {
		$scope.currentPage = n;
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
