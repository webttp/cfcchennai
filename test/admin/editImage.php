<?php 
	  include("../config/Class.Crud.Php"); 
	  include("header.php");
	  $tablename='messagelist';
	  if(isset($_GET['id'])){
		$messageid=$_GET['id'];
	  }
	  $messageid = array("id"=>$messageid);
	  $fetch=$obj->fetch($tablename, $messageid);
	  if(count($fetch)>0)
	  {
?>
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#messagedate" ).datepicker({
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
					<form role="form" name="myForm" method="post" class="form-horizontal" action="editMessage.php">
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Date</label>
					<div class="col-md-4">
					<?php
			$spartstext = explode('-', $fetch['0']['date']);
			$sdatetext  = "$spartstext[1]/$spartstext[2]/$spartstext[0]";
?>					
					<input name="messagedate"  value="<?php echo $sdatetext?>" type= "text" class= "form-control" id="messagedate" placeholder="Message Date" required/>
					</div>
					</div>
					
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2">Location</label>
					<div class="col-md-4">
					<select class="form-control" id="location" name="location"  required>
						<option value="">Select CFC - Location</option>
						<option <?php if($fetch['0']['location']=='CFC-Thirumullaivoyal'){echo "selected=selected";} ?> value="CFC-Thirumullaivoyal">CFC-Thirumullaivoyal</option>
						<option <?php if($fetch['0']['location']=='CFC-Tambaram'){echo "selected=selected";} ?> value="CFC-Tambaram">CFC-Tambaram</option>
					</select>
					</div>
					</div> 
					
					<div class= "form-group">
					<label class= "col-md-2">Message Title </label>
					<div class="col-md-4">
					<input name="messagetitle" value="<?php echo $fetch['0']['title']?>" type= "text" class= "form-control" id="messagetitle" placeholder="Message Title" required/>
					</div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2">Speaker</label>
					<div class="col-md-4"><?php 
					$speaker=array("Prakasam","Micheal","Jesudoss","Johnrajan");
					?>
					<select class="form-control"  id="speaker" ng-model="speaker.type" name="speaker" required>
						<option ng-option value="">Select Speaker</option>
						<option ng-option <?php if(in_array($fetch['0']['speaker'],$speaker)){echo "selected=selected";} ?> value="Prakasam">Prakasam</option>
						<option ng-option <?php if(in_array($fetch['0']['speaker'],$speaker)){echo "selected=selected";} ?> value="Micheal">Micheal</option>
						<option ng-option <?php if(in_array($fetch['0']['speaker'],$speaker)){echo "selected=selected";} ?> value="Jesudoss">Jesudoss</option>
						<option <?php if(in_array($fetch['0']['speaker'],$speaker)){echo "selected=selected";} ?> ng-option value="Johnrajan">Johnrajan</option>
						<option <?php if(!in_array($fetch['0']['speaker'],$speaker)){echo "selected=selected";} ?> ng-option value="others">others</option>
					</select>
					</div>
					</div>
					<div class= "form-group" id="video" ng-if="speaker.type == 'others'">
					<label class= "col-md-2">enter the other speaker</label>
					<div class="col-md-4">
					<input name="otherspeaker" value="<?php echo $fetch['0']['speaker']?>" type= "text" class= "form-control" id="otherspeaker" placeholder="Enter the other speaker" required/></div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2">Message Type</label>
					<div class="col-md-4">
					<select class="form-control"  id="messtype" ng-change="changeme()" ng-model="message.type" name="messtype" required>
						<option   value="">Select Message Type</option>
						<option   <?php if($fetch['0']['messagetype']=='video'){echo "selected=selected";} ?> value="video">Video</option>
						<option   <?php if($fetch['0']['messagetype']=='audio'){echo "selected=selected";} ?> value="audio">Audio</option>
						<option   <?php if($fetch['0']['messagetype']=='both'){echo "selected=selected";} ?>  value="both">Both</option>
					</select>
					</div>
					</div>
					<div class= "form-group" id="video" ng-if="message.type == 'video' || message.type == 'both'">
					<label class= "col-md-2">Video Key</label>
					<div class="col-md-4">
					<input name="videokey"  value="<?php echo $fetch['0']['videokey']?>" type= "text" class= "form-control" id="videokey" placeholder="Enter the Video Key" required/></div>
					</div>
					<div class= "form-group" id="audio" ng-if="message.type == 'audio' || message.type == 'both'">
					<label class= "col-md-2">Audio Key</label>
					<div class="col-md-4">
					<input name="audiokey" value="<?php echo $fetch['0']['audiokey']?>" type= "text" class= "form-control" id="audiokey" placeholder="Enter the Audio Key" required/></div>
					
					</div>
						<input type="hidden" value="<?php echo $fetch['0']['id'];?>" name="hiddenmesageid">
					
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
		}
	if(isset($_POST['submit'])!=""){
		
	
		
		$loginid=$_SESSION['loginid'];
		$currentdt=date('Y-m-d H:i:s',time());
		
		$msgid=$_POST['hiddenmesageid'];
		$sparts = explode('/', $_POST['messagedate']);
				$date  = "$sparts[2]-$sparts[0]-$sparts[1]";
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
		$videokey=$_POST['videokey'];
		$audiokey=$_POST['audiokey'];
		$condition = array("id"=>$msgid);
		$set = array("date"=>$date,"location"=>$location,"title"=>$title,"speaker"=>$speaker,
					 "messagetype"=>$messagetype,"videokey"=>$videokey,"audiokey"=>$audiokey,
					 "modifiedby"=>$loginid,"modifieddate"=>$currentdt);	
		$msg=$obj->update($tablename, $set,$condition);
		header("location:listmessages.php");
	}				
?>
<script src="../js/angular.min.js"></script>
<script type="text/javascript">
 var myApp = angular.module('myApp',[]);
 function MyCtrl($scope) {
	 
	 
	 
 }
</script>
