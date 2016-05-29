<?php 
	  include("../config/Class.Crud.Php"); 
	  include("header.php");
	  if(isset($_GET['id'])){
		$messageid=$_GET['id'];
	  }
?>	  
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="container" ng-app="myApp">
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<a class= "navbar-brand" href= "listmessages.php"><i class="glyphicon glyphicon-th-large"></i> Messages List </a>
				</div>
			</div>
		<div class="row" ng-controller="MyCtrl">
			<div class="col-md-12">
				<div ng-show="!loaded"> <center style="text-align:center !important;"><i class="fa fa-spinner fa-spin fa-3x fa-fw margin-bottom"></i>
				</center>
				</div>
				<form role="form" name="myForm" method="post" class="form-horizontal" action="editMessage.php">
				<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Date</label>
					<div class="col-md-4">
					<input name="messagedate"  ng-model="messagedate" type= "text" class= "form-control" id="messagedate" placeholder="Message Date" required/>
					</div>
				</div>
				
				<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2">Location</label>
					<div class="col-md-4">
					<select class="form-control" ng-model="churchlocation" id="location" name="location"  required>
						<option value="">Select CFC - Location</option>
						<option ng-option value="CFC-Thirumullaivoyal">CFC-Thirumullaivoyal</option>
						<option ng-option value="CFC-Tambaram">CFC-Tambaram</option>
					</select>
					</div>
				</div> 
				<div class= "form-group">
					<label class= "col-md-2">Message Title </label>
					<div class="col-md-4">
					<input name="messagetitle" ng-model="messagetitle" type= "text" class= "form-control" id="messagetitle" placeholder="Message Title" required/>
					</div>
				</div>
				<div class= "form-group">
					<label class= "col-md-2">Speaker</label>
					<div class="col-md-4">
					<select class="form-control"  id="speaker" ng-model="speakerchennai" name="speaker" required>
						<option ng-option value="Prakasam">Prakasam</option>
						<option ng-option value="Micheal">Micheal</option>
						<option ng-option value="Jesudoss">Jesudoss</option>
						<option ng-option value="Johnrajan">Johnrajan</option>
						<option ng-option value="others">others</option>
					</select>
					</div>
					</div>
				<div class= "form-group" id="video" ng-if="speakerchennai == 'others'">
					<label class= "col-md-2">enter the other speaker</label>
					<div class="col-md-4">
					<input name="otherspeaker" ng-model="speakerother" type= "text" class= "form-control" id="otherspeaker" placeholder="Enter the other speaker" required/></div>
				</div>
				<div class= "form-group">
					<label class= "col-md-2">Message Type</label>
					<div class="col-md-4">
					<select class="form-control"  id="messtype" ng-change="changeme()" ng-model="messagetype" name="messtype" required>
						<option   value="">Select Message Type</option>
						<option   ng-option value="video">Video</option>
						<option   ng-option value="audio">Audio</option>
						<option   ng-option  value="both">Both</option>
					</select>
					</div>
				</div>
				<div class= "form-group" id="video"  ng-if="messagetype == 'video' || messagetype == 'both'">
					<label class= "col-md-2">Video Url</label>
					<div class="col-md-4">
					<input name="videokey"   ng-model="videotype" type= "text" class= "form-control" id="videokey" placeholder="Enter the Video Url" required/></div>
				</div>
				<div class= "form-group" id="audio"  ng-if="messagetype == 'audio' || messagetype == 'both'">
					<label class= "col-md-2">Audio Url</label>
					<div class="col-md-4">
					<input name="audiokey"  ng-model="audiotype" type= "text" class= "form-control" id="audiokey" placeholder="Enter the Audio Url" required/>
					</div>
				</div>
				<input type="hidden" value="<?php echo $messageid;?>" name="hiddenmesageid" id="hiddenmesageid">
				<div class= "form-group">
					<label class= "col-md-2"></label>
					<div class="col-md-4">
					<button name="submit" class="btn btn-primary">Submit</button>
					<a href="listmessages.php" class="btn">Cancel</a> 
					</div>
				</div>
				</form>
			</div>
        </div>
</div>
	</body>
</html>	
<?php
if(isset($_POST['submit'])!=""){
		$loginid=$_SESSION['loginid'];
		$currentdt=date('Y-m-d H:i:s',time());
		$msgid=$_POST['hiddenmesageid'];
		$sparts = explode('/', $_POST['messagedate']);
 -		$date  = "$sparts[2]-$sparts[0]-$sparts[1]";
		$location=$_POST['location'];
		$title=$_POST['messagetitle'];
		$speaker=$_POST['speaker'];
		$speaker=$_POST['speaker'];
		if($speaker=="others")
		{
			$speaker=$_POST['otherspeaker'];
		}
		else
		{
			$speaker=$_POST['speaker'];
		}
		$messagetype=$_POST['messtype'];
		$videokey="0";
		$audiokey="0";
		switch($messagetype)
		{
			case 'audio':
			$audiokey=$_POST['audiokey'];
			break;
			case 'video':
			$videokey=$_POST['videokey'];
			break;
			case 'both':
			$videokey=$_POST['videokey'];
			$audiokey=$_POST['audiokey'];
			break;
					
		}	
		$condition = array("id"=>$msgid);
		$set = array("date"=>$date,"location"=>$location,"title"=>$title,"speaker"=>$speaker,
					 "messagetype"=>$messagetype,"videokey"=>$videokey."?rel=0&autoplay=0&enablejsapi=1&origin=http://cfcchennai.church","audiokey"=>$audiokey,
					 "modifiedby"=>$loginid,"modifieddate"=>$currentdt);	
		$tablename='messagelist';
		$msg=$obj->update($tablename, $set,$condition);
		?>
					<script type="text/javascript">
					window.location="listmessages.php";
					</script>
		<?php
	}				
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
  $(function(){
    $( "#messagedate").datepicker({
      dateformat: "yy-mm-dd",
      showOn: "button",
      buttonImage: "../../images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  });
</script>
<script src="../js/angular.min.js"></script>
<script type="text/javascript">
 angular.module('myApp', []).controller('MyCtrl',MyCtrl);
 function MyCtrl($scope, $http, $timeout) {
	var id=document.getElementById('hiddenmesageid').value;
	$http.get('getMessages.php?action='+'edit&id='+id).success(function(data){
		$scope.loaded = true;
		$scope.messagedate=data.messagedate;
		$scope.churchlocation=data.churchlocation;
		$scope.messagetitle=data.messagetitle;
		$scope.speakerchennai=data.speakerchennai;
		$scope.speakerother=data.speakerother;
		$scope.messagetype=data.messagetype;
		$scope.videotype=data.videotype;
		$scope.audiotype=data.audiotype;
    }); 
}
</script>
