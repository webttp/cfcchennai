var sermonApp = angular.module('sermonApp', ['angular-toArrayFilter', 'angular-underscore']);

sermonApp.controller('sermonController',function($scope, $http, $timeout){
   // setting the number of records per page
   $scope.messages = [];
   $scope.selected_date;
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
   
   $scope.messagetriggerbydate = function(date) {
	   var messageDateArray = [];
			$http.get('admin/getMessages.php?action=start').success(function(data){
			angular.forEach(data, function(item) {
				if(item.date == date)
					messageDateArray.push(item);
			});
			$scope.messages = messageDateArray;
			$scope.pageLimit = 5; // setting the number of records per page
	});
   }
   
   $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    
    /* date picker functionalities */
    $scope.formatDate = function (date) {
    function pad(n) { return n < 10 ? '0' + n : n };

    return date
        ?  pad(date.getDate()) + '-' + pad(date.getMonth() + 1) + '-' + date.getFullYear() : '';
	};
	$scope.parseDate = function (s) {
	    var tokens = /^(\d{4})-(\d\d)-(\d\d)$/.exec(s);
	
	    return tokens && new Date(tokens[1], tokens[2] - 1, tokens[3]);
	};
	$scope.loadByDate = function(date) {
			$http.get('admin/getMessages.php?action='+'locate&'+'date='+date).success(function(data){
			$scope.messages = data;
			$scope.pageLimit = 5; // setting the number of records per page
		});
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
