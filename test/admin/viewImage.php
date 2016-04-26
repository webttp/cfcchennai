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
					
					<div class= "form-group">
					<label class= "col-md-2"></label>
					<div class="col-md-4">
					<img src="imagebank/<?php echo $fetch['0']['imgsrc']?>">
					<a href="listimages.php" class="btn">Back to Gallery</a> 
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
	