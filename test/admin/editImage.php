<?php 
	  error_reporting('0');

	  include("../config/Class.Crud.Php"); 
	  include("header.php");
	  $tablename='imagegallery';
	  if(isset($_GET['id'])){
		$imgid=$_GET['id'];
	  }
	  $imgid = array("imgid"=>$imgid);
	  $fetch=$obj->fetch($tablename, $imgid);
	  if(count($fetch)>0)
	  {
?>		<div class="container">
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<a class= "navbar-brand" href= "listimages.php"><i class="glyphicon glyphicon-th-large"></i> Image Gallery </a>
				</div>	
			</div>	
            <div class="row">
				<div class="col-md-12">
					<form role="form" enctype="multipart/form-data" name="myForm" method="post" class="form-horizontal" action="editImage.php">
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Image Name</label>
					<div class="col-md-4">
					<input name="imagename"  type= "text" class= "form-control" value="<?php echo $fetch['0']['imagename']?>" id="imagename" placeholder="Image Name" required/>
					</div>
					</div>
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2"> Choose a Image to upload: </label>
					<div class="col-md-4">
					<input name="uploadedfile" value="<?php echo $fetch['0']['imgsrc']?>" type="file" id="uploadImage" class="target" /> <img src="imagebank/thumbnail/<?php echo $fetch['0']['imgsrc']?>">
					<input type="hidden" name="hiddenupload" value="<?php echo $fetch['0']['imgsrc']?>" id="hiddenupload" >
					<input type="hidden" name="hiddenimgid" value="<?php echo $fetch['0']['imgid']?>" id="hiddenimgid" >
					</div>
					</div>
					<div class= "form-group" ng-class="{error: myForm.name.$invalid}">
					<label class= "col-md-2">Image Alt Text</label>
					<div class="col-md-4">
					<input name="imagealttext"  type= "text"  required class= "form-control" value="<?php echo $fetch['0']['imgalttext']?>" id="imagealttext" placeholder="Image Alt Text" />
					</div>
					</div>
					<div class= "form-group">
					<label class= "col-md-2">Redirect Url </label>
					<div class="col-md-4">
					<input name="imageredirect"  type= "text" class= "form-control" value="<?php echo $fetch['0']['redirectlink']?>" id="imageredirect" placeholder="Redirect Link" />
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
	  }
	if(isset($_POST['submit'])!=""){
		function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}
				$tablename='imagegallery';
				$imagename=$_POST['imagename'];
				$imagealttext=$_POST['imagealttext'];
				$hiddenimgid=$_POST['hiddenimgid'];
				$upload_img = cwUpload('uploadedfile','imagebank/','',TRUE,'imagebank/thumbnail/','200','160');
				$imageredirect=$_POST['imageredirect'];
				$hiddenupload=$_POST['hiddenupload'];
				$loginid=$_SESSION['loginid'];
				$currentdt=date('Y-m-d H:i:s',time());
				
				if($upload_img=='')
				{
					$imgupload=$hiddenupload;
				}
				else
				{
					$imgupload=$upload_img;
					$hiddenimg=$_POST['hiddenupload'];
					unlink("imagebank/".$hiddenimg);
					unlink("imagebank/thumbnail/".$hiddenimg);
				}
				$set = array("imagename"=>$imagename,"imgalttext"=>$imagealttext,"imgsrc"=>$imgupload,"redirectlink"=>$imageredirect,"modifiedby"=>$loginid,"modifieddate"=>$currentdt);
				
				$condition = array("imgid"=>$hiddenimgid);
				
				
				$update=$obj->update($tablename, $set,$condition);
				
				
				?>
					<script type="text/javascript">
				window.location="listimages.php";
				</script>
		<?php
	}				
?>
<style type="text/css">
input[type=file]{ 
        color:transparent;
    }
</style>
<script type="text/javascript">
$(document).ready(function() {
	
	
    $('#upload').bind("click",function() 
    { 
		var imagename=$('#imagename').val();
		var hiddenupload = $('#hiddenupload').val(); 
		var imgVal = $('#uploadImage').val(); 
		var imagealttext=$('#imagealttext').val();
		var imageredirect=$('#imageredirect').val();
		if(imagename=='')
		{
			alert('Please Enter the Image Name');
			$('#imagename').focus();
			return false;
		}
		else if(hiddenupload=='' && imgVal=='') 
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
