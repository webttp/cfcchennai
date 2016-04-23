<?php
include("../config/Class.Crud.Php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CFC - Admin</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"  />
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="../utils/html5shiv.min.js"></script>
          <script src="../utils/respond.min.js"></script>
         
        <![endif]-->
		<style type="text/css">

      @import "bourbon";
		.wrapper {
				margin-top: 80px;
				margin-bottom: 80px;
		}
		.form-signin {
			max-width: 380px;
			padding: 15px 35px 45px;
			margin: 0 auto;
			background-color: #fff;
			border: 1px solid rgba(0,0,0,0.1);
			.form-signin-heading,
			.checkbox {
				margin-bottom: 30px;
			}
			.checkbox {
				font-weight: normal;
			}
			.form-control {
				position: relative;
				font-size: 16px;
				height: auto;
				padding: 10px;
				@include box-sizing(border-box);
				&:focus {
					z-index: 2;
				}
			}
			input[type="text"] {
				margin-bottom: -1px;
				border-bottom-left-radius: 0;
				border-bottom-right-radius: 0;
			}
			input[type="password"] {
				margin-bottom: 20px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
		}
</style>
    </head>
    <body>
    <?php if(!isset($_GET['action']))
    {
    	?>
    
    	<div class="container">
            <div class="navbar-header">
				<a class="navbar-brand" href="login.php">
					<img src="../../images/Cfc_Chennai_Logo.jpg" alt="Rechat HR Consulting" title="Rechat HR Consulting">        
				</a>
			</div>
            <div class="row">
                <div class="wrapper">
					<form class="form-signin" method="post" action="resetpassword.php">
					<div class="usernotfound" style="display:none"></div>
					
					  <h2 class="form-signin-heading">Reset -  Password</h2>
					  
					  Enter your email
					  <input  id="emailid" type="text" class="form-control" name="user[emailid]" placeholder="Email" required="true" />
					
					  <br/>
					 
					  <br/>
					  <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin" value="Search">Search</button>
					</form>
				</div>
            </div>
            <?php 
    }
            ?>
        </div>
         <script src="../js/jQuery.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
<?php if(isset($_POST['btnLogin']))
{
			$tablename="user";
			$usermailid=$_POST['user']['emailid'];
			$userMailid = array("user_email"=>$usermailid);
			$fetch=$obj->fetch($tablename, $userMailid);
			if(count($fetch)>0)
			{
				
					
				 
				 
				 $activationcode=md5($usermailid.time());
					
					
					
					$user_id=$fetch['0']['user_id'];
					
					$set = array("activation_key"=>$activationcode);
					
					$condition = array("user_id"=>$user_id,"status"=>'1');
					
					$msg=$obj->update($tablename, $set,$condition);
				
				
					if($msg=="Record updated successfully")
					{
									
					die('<img src="../img/not-available.png" />'.'Your password reset link send to your e-mail address.');
					die ('mail send Click here to reset your password http://resetpassword.php?encrypt=$activationcodee&action=reset ');
					}
			}
			else if(count($fetch)=="0")
			{
				die('<img src="../img/not-available.png" />'.'Sorry We couldnt find your account with that information.');
			}
			
			
			
			
}

if(isset($_GET['action'])=="reset")
{
	session_start();
	$encrypt=$_GET['encrypt'];
	$id=$_SESSION['loginid'];
	$tablename="user";
	$userMailid = array("activation_key"=>$encrypt,"user_email"=>$id,"status"=>1);
	
	 $fetch=$obj->fetch($tablename, $userMailid);
	
	if(count($fetch)>0)
	{
		?><div class="row">
		<div class="wrapper">
		<form class="form-signin" method="post" action="updatepassword.php">
		<div class="usernotfound" style="display:none"></div>
			<input type="hidden" value="<?php echo $id ?>" name="user[userhidden]">
				<input type="hidden" value="<?php echo $encrypt ?>" name="user[encrypt]">
		<h2 class="form-signin-heading">Confirm Password</h2>
			<?php if(isset($_GET['password'])=="notequal")
			{
				?>
			<span id="user-email">Password and confirm password is not same</span>
			<?php }?>
		Enter your New password
		<input  id="repassword" type="password" class="form-control" name="user[repassword]" placeholder="Password" required="true" />
	Re - Enter your New password
		<input  id="conpassword" type="password" class="form-control" name="user[conpassword]" placeholder="Confirm Password" required="true" />
		<br/>
		
		<br/>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="rePassword" value="Submit">Click to Update</button>
		</form>
		</div>
		</div>
	<?php
	}
	else {
		echo "Verified code is wrong .";
	}

}
?>