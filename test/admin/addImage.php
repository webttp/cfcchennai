<?php 
	  include("header.php");
	  error_reporting('0');
	  ini_set('max_execution_time', 300); //300 seconds = 5 minutes

?>
    	<div class="container">
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<a class= "navbar-brand" href= "listimages.php"><i class="glyphicon glyphicon-th-large"></i> Image Gallery </a>
				</div>	
			</div>	
            <div class="row">
				<div class="col-md-12">
					<form role="form" enctype="multipart/form-data" name="myForm" method="post" class="form-horizontal" action="addImage.php">
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Image Name</label>
					<div class="col-md-4">
					<input name="imagename"  type= "text" class= "form-control" id="imagename" placeholder="Image Name"/>
					</div>
					</div>
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Choose a Image to upload: </label>
					<div class="col-md-4">
					<input name="uploadedfile" type="file" id="uploadImage" />
					</div>
					</div>
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2">Image Alt Text</label>
					<div class="col-md-4">
					<input name="imagealttext"  type= "text" class= "form-control" id="imagealttext" placeholder="Image Alt Text" />
					</div>
					</div>
				
					<div class= "form-group">
					<label class= "col-md-2">Redirect Url </label>
					<div class="col-md-4">
					<input name="imageredirect"  type= "text" class= "form-control" id="imageredirect" placeholder="Redirect Link" />
					</div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2"></label>
					<div class="col-md-4">
					<button name="submit" class="btn btn-primary" id="upload">Submit</button>
					<a href="listimages.php" class="btn">Cancel</a> 
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
		
				$tablename='imagegallery';
				$imagename=$_POST['imagename'];
				$imagealttext=$_POST['imagealttext'];
				include("imageUpload.php");
				$upd = new imageUpload("uploadedfile");
				$upd->setUploadPath("imagebank/");
				$upd->setThumbPath("imagebank/thumbnail/");
				$upd->setCreateThumbnail(true);
				$upd->setThumbDimension(100, 100);
				$upd->setMaxFileSize(5242880); //in bytes, around 5mb
				$upd->setThumbMode("crop");
				echo "uiii";
				
				$image_uploaded = $upd->uploadImg();
				echo "aaaaa";
				exit;
				
				if($image_uploaded !== false){     
				//echo("File uploaded");
				//proceed database
				}else{
				   if($upd->isUploadError()){
					  //show errors
					  $msg = $upd->getUploadMsg();
					  
				   }else echo("Oops! unknown error");   
				}  
				$imageredirect=$_POST['imageredirect'];
				$loginid=$_SESSION['loginid'];
				$currentdt=date('Y-m-d H:i:s',time());
				$InsColumnVal = array("imagename"=>$imagename,"imgalttext"=>$imagealttext,"imgsrc"=>$image_uploaded,"redirectlink"=>$imageredirect);
				include("../config/Class.Crud.Php"); 
			
				if($obj->insert($tablename, $InsColumnVal)=="New record has been inserted successfully!"){
					?>
					<script type="text/javascript">
					window.location="listimages.php";
					</script>
					<?php
				}
	}				
?>
<script type="text/javascript">
$(document).ready(function()
{
    $('#upload').bind("click",function() 
    { 
		var imagename=$('#imagename').val();
		var imgVal = $('#uploadImage').val(); 
		var imagealttext=$('#imagealttext').val();
		var imageredirect=$('#imageredirect').val();
		if(imagename=='')
		{
			alert('Please Enter the Image Name');
			$('#imagename').focus();
			return false;
		}
		else if(imgVal=='') 
        { 
            alert("Please Upload the Image "); 
			return false; 
        } 
		else if(imagealttext=='')
		{
			alert('Please Enter the Image Alt Text');
			$('#imagealttext').focus();
			return false;
	}
		else if(imageredirect!='')
		{
			 var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
			 if (!pattern.test(imageredirect)) {
				alert("Please enter the valid url!");
				$('#imageredirect').focus();
				return false;
			  } 
				
		}
        return true;
	}); 
});
</script> 
