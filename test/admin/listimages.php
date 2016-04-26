<?php
include("header.php");
?>
<div  ng-app="myApp">
<div ng-controller="imgCrtl" class="container" >
<br/>
<br/>
<nav class= "navbar navbar-default" role= "navigation" style="margin-top:20px;">
				<div class= "navbar-header" >
					<a class="btn btn-lg btn-success" href="addImage.php"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add new Image</a>
				</div>
			</nav>
<div ng-show="!loaded"> <center style="text-align:center !important;"><i class="fa fa-spinner fa-spin fa-3x fa-fw margin-bottom"></i>
</center>
</div>

    <div class="row" ng-show="loaded">
        
        <div class="col-md-3">Filter:
            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
        </div>
		
    </div>
	
    <br/>
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
			
            
            <th>Image Title&nbsp;</th>
			<th>Image Alt Text&nbsp;</th>
            <th>Redirect Link&nbsp;</th>
			<th>Thumbnail Image&nbsp;</th>
			<th>Action&nbsp;</th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.imagename}}</td>
                    <td>{{data.imgalttext}}</td>
                    <td>{{data.redirectlink}}</td>
					<td><img src="imagebank/thumbnail/{{data.imgsrc}}"></td>
					<td>
					<a onclick="action(this.id,'view')" id="{{data.imgid}}">&nbsp;<i class="glyphicon glyphicon-view"></i>&nbsp;View Image</a>
					<a onclick="action(this.id,'edit')" id="{{data.imgid}}" class="btn">&nbsp;<i class="glyphicon glyphicon-edit"></i>&nbsp; Edit Image</a>
				<a  onclick="action(this.id,'del')" id="{{data.imgid}}" class="btn">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp; Delete Image</a>
				
				
				</td>
                 </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No Images found</h4>
            </div>
        </div>
        <div class="col-md-12" ng-show="filteredItems > 0">    
            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></div>
          
        </div>
    </div>
</div>
</div>
<script src="../js/angular.min.js"></script>
<script src="../js/ui-bootstrap-tpls-0.10.0.min.js"></script>
<script src="../js/app.js"></script> 
<script type="text/javascript">

function action(id,action)
{
	var action;
	if(action=="del")
	{
		var result=confirm("Are you Sure to delete this Image?");
		if(result)
		{
			window.location.href="deleteImage.php?id="+id;
		}
	}
	else if(action=="edit")
	{
			window.location.href="editImage.php?id="+id;
	}
	else if(action=="view")
	{
			window.location.href="viewImage.php?id="+id;
	}	
}
</script>        
    </body>
</html>
