<?php 
	  include("header.php");
	  error_reporting('0');
?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
	  var d = new Date();
    $( "#messagedate" ).datepicker({
		maxDate:new Date(d.setDate(d.getDate() )),
      showOn: "button",
      buttonImage: "../../images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
    });
  });
  </script>

			<div class="container" ng-app="myApp" >
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<a class= "navbar-brand" href= "listmessages.php"><i class="glyphicon glyphicon-th-large"></i> Messages List </a>
				</div>	
			</div>	
            <div class="row" ng-controller="MyCtrl">
				<div class="col-md-12">
					<form role="form" name="myForm" method="post" class="form-horizontal" action="addNewMessage.php">
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Date</label>
					<div class="col-md-4">
					<input name="messagedate"  type= "text" class= "form-control" id="messagedate" placeholder="Message Date" required/>
					</div>
					</div>
					
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2">Location</label>
					<div class="col-md-4">
					<select class="form-control" id="location" name="location" required>
						<option value="">Select CFC - Location</option>
						<option value="CFC-Thirumullaivoyal">CFC-Thirumullaivoyal</option>
						<option value="CFC-Tambaram">CFC-Tambaram</option>
					</select>
					</div>
					</div>
				
					<div class= "form-group">
					<label class= "col-md-2">Message Title </label>
					<div class="col-md-4">
					<input name="messagetitle"  type= "text" class= "form-control" id="messagetitle" placeholder="Message Title" required/>
					</div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2">Speaker</label>
					<div class="col-md-4">
					<select class="form-control" ng-model="speaker.type" id="speaker"  name="speaker" required>
						<option ng-option value="">Select Speaker</option>
						<option ng-option value="Prakasam">Prakasam</option>
						<option ng-option value="Micheal">Micheal</option>
						<option ng-option value="Jesudoss">Jesudoss</option>
						<option ng-option value="Johnrajan">Johnrajan</option>
						<option ng-option value="others">others</option>
						
					</select>
					</div>
					</div>
					<div class= "form-group" id="video" ng-if="speaker.type == 'others'">
					<label class= "col-md-2">enter the other speaker</label>
					<div class="col-md-4">
					<input name="otherspeaker"  type= "text" class= "form-control" id="otherspeaker" placeholder="Enter the other speaker" required/></div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2">Message Type</label>
					<div class="col-md-4">
					<select class="form-control" ng-model="message.type" id="messtype"  name="messtype" required>
						<option ng-option value="">Select Message Type</option>
						<option ng-option value="video">Video</option>
						<option ng-option value="audio">Audio</option>
						<option ng-option value="both">Both</option>
					</select>
					</div>
					</div>
					<div class= "form-group" id="video" ng-if="message.type == 'video' || message.type == 'both'">
					<label class= "col-md-2">Video Key</label>
					<div class="col-md-4">
					<input name="videokey"  type= "text" class= "form-control" id="videokey" placeholder="Enter the Video Key" required/></div>
					</div>
					<div class= "form-group" id="audio" ng-if="message.type == 'audio' || message.type == 'both'">
					<label class= "col-md-2">Audio Key</label>
					<div class="col-md-4">
					<input name="audiokey"  type= "text" class= "form-control" id="audiokey" placeholder="Enter the Audio Key" required/></div>
					</div>
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
				$tablename='messagelist';
				$sparts = explode('/', $_POST['messagedate']);
				$date  = "$sparts[2]-$sparts[0]-$sparts[1]";
		
				$location=$_POST['location'];
				$messagetitle=$_POST['messagetitle'];
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
				$loginid=$_SESSION['loginid'];
				$currentdt=date('Y-m-d H:i:s',time());
				include("../config/Class.Crud.Php"); 		
				$InsColumnVal = array("date"=>$date,"location"=>$location,"title"=>$messagetitle,"speaker"=>$speaker,"messagetype"=>                      $messagetype,"videokey"=>$videokey,"audiokey"=>$audiokey,"uploadedby"=>$loginid,"uploadeddate"=>	                    $currentdt);
				if($obj->insert($tablename, $InsColumnVal)=="New record has been inserted successfully!")
				{
					?>
					<script type="text/javascript">
				window.location="listmessages.php";
				</script>
		<?php
				}
				
	}				
?>
<script src="../js/angular.min.js"></script>
<script src="../js/app.js"></script>
<script type="text/javascript">
var myApp = angular.module('myApp',[]);
	myApp.controller("MyCtrl",function ($scope) {
});
</script>
