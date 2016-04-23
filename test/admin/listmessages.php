<?php
include("header.php");
?>
<div  ng-app="myApp">
<div ng-controller="customersCrtl" class="container" >
<br/>
<br/>
<nav class= "navbar navbar-default" role= "navigation" style="margin-top:20px;">
				<div class= "navbar-header" >
					<a class="btn btn-lg btn-success" href="addNewMessage.php"><i class="glyphicon glyphicon-plus"></i>&nbsp;Add new Message</a>
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
	 <div  class="pull-right">Location :
            <select class="form-control" id="location" ng-change="locationtrigger(selectedlocation)" name="location" ng-model="selectedlocation">
						<option value="CFC-both">CFC - All</option>
						<option value="CFC-Thirumullaivoyal">CFC-Thirumullaivoyal</option>
						<option value="CFC-Tambaram">CFC-Tambaram</option>
					</select>
        </div>
    <br/>
    <div class="row">
        <div class="col-md-12" ng-show="filteredItems > 0">
            <table class="table table-striped table-bordered">
            <thead>
			
            <th><a ng-click="sort_by('date');">Date&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>
            <th>Title&nbsp;</th>
            <th>Speaker&nbsp;<a ng-click="sort_by('speaker');"><i class="glyphicon glyphicon-sort"></i></a></th>
			<th>Message Type&nbsp;<a ng-click="sort_by('messagetype');"><i class="glyphicon glyphicon-sort"></i></a></th>
			<th>Action&nbsp;</th>
            </thead>
            <tbody>
                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                    <td>{{data.date | date:'dd-MM-yyyy'}}</td>
                    <td>{{data.title}}</td>
                    <td>{{data.speaker}}</td>
					<td>{{data.messagetype}}</td>
					<td><a onclick="action(this.id,'edit')" id="{{data.id}}" class="btn">&nbsp;<i class="glyphicon glyphicon-edit"></i>&nbsp; Edit Message</a>
				<a  onclick="action(this.id,'del')" id="{{data.id}}" class="btn">&nbsp;<i class="glyphicon glyphicon-remove"></i>&nbsp; Delete Message</a></td>
                 </tr>
            </tbody>
            </table>
        </div>
        <div class="col-md-12" ng-show="filteredItems == 0">
            <div class="col-md-12">
                <h4>No messages found</h4>
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
		var result=confirm("Are you Sure to delete this Message?");
		if(result)
		{
			window.location.href="deleteMessage.php?id="+id;
		}
	}
	else if(action=="edit")
	{
			window.location.href="editMessage.php?id="+id;
	}	
}
</script>        
    </body>
</html>