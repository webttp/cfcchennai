<?php

session_start();

if($_SESSION['loginid']=="")
{
	header("location:login.php?msg=userinvalid");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Preferred Partner :  Klaire & Jones – The Preferred Partner in Leadership Hiring and Executive Search
- Admin</title>
        <link rel="stylesheet" type="text/css" href="utils/bootstrap-3.3.4-dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="utils/bootstrap-3.3.4-dist/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="css/global-style.css" />
				<style>		
		@import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css");
		</style>
    </head>
    <body>
        <div class="container" style="border-color: #ddd;">
            <div class="navbar-header" >
				<a class="navbar-brand" href="login.php">
					<img src="images/logo.gif" alt="Preferred Partner :  Klaire & Jones – The Preferred Partner in Leadership Hiring and Executive Search
" title="Preferred Partner :  Klaire & Jones – The Preferred Partner in Leadership Hiring and Executive Search
" />               
				</a>
			</div>  
			<div class="row">
			
		       <div class="col-md-12"><span class="pull-right"><?php  echo 'Welcome   '. $_SESSION['loginname']; ?>
				   <a href="logout.php">Logout</a>
				   </span>
			   </div>
		    </div>
			<nav class= "navbar navbar-default" role= "navigation" style="margin-top:20px;">
				<div class= "navbar-header" >
					<a class="btn btn-lg btn-success" href="addNewJob.php"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add new Job</a>
				</div>
			</nav>
            <div class="row">
			    <div class="col-md-12">
			    <table ng-app="myApp" ng-controller="customersCtrl" class="table table-striped table-bordered">
						<thead>
						<th class="name"><a ng-click="sort_by('Name')">Name <i class="fa fa-sort"></i></a></th>
						<th>Job Title&nbsp;</th>
						<th>Job Code&nbsp;</th>
						<th>Role Expectation&nbsp;</th>
						<th>Role Requirement&nbsp;</th>
						<th>Ideal Candidate&nbsp;</th>
						<th>Location&nbsp;</th>
						<th>Action&nbsp;</th>
						</thead>
					<tbody>
					
		<?php 
		function cityname($id,$conn)
		{
			$sql2 = <<<SQL
			SELECT * FROM `cities` where city_id='$id'   
SQL;
			$result2 = $conn->query($sql2);
			$getrec2=mysqli_fetch_object($result2);
			return $getrec2->city_name;
		}
		function statename($id,$conn)
		{
			$sql2 = <<<SQL
			SELECT * FROM `states` where state_id='$id'   
SQL;
			$result2 = $conn->query($sql2);
			$getrec2=mysqli_fetch_object($result2);
			return $getrec2->state_name;
		}
		include("paginationscript.php");
		?>
    	<tr ng-repeat="x in names" | orderBy:sortingOrder:reverse">
    <td>{{ x.prod_name }}</td>
    <td>{{ x.prod_price }}</td>
  </tr>
        </tbody>
        </table>
		<div class="bs-example">
		<?php echo $pagination; ?>
        </div>
    </div>
   </div>
  </div>
        <script src="utils/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="utils/bootstrap-3.3.4-dist/js/bootstrap.min.js" type="text/javascript"></script>     
        <script src="scripts/global-script.js" type="text/javascript"></script>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("db.php?action=get_product")
   .then(function (response) {$scope.names = response.data;});
   
   // change sorting order
  $scope.sort_by = function(newSortingOrder) {
    if ($scope.sortingOrder == newSortingOrder)
      $scope.reverse = !$scope.reverse;
    
    $scope.sortingOrder = newSortingOrder;
  };

});
</script>
<script type="text/javascript">
function deleteConfirm(id)
{
	var result=confirm("Are you Sure to delete this Job?");
	if(result)
	{
		window.location.href="deleteJob.php?id="+id;
	}
}
</script>