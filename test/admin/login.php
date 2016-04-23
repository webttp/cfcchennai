<?php
include("../config/Class.Crud.Php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CFC-Admin</title>
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
		div.sidetip{
			position: absolute;
    left: 830px;
    width: 300px;
    display: table;
    min-height: 92px;
    margin-top: -6px;
    margin-left: 10px;
		}
		div.sidetip p {
    font-size: 13px;
    line-height: 16px;
    padding-left: 18px;
    background-repeat: no-repeat;
    background-position: 0 9px;
    color: gray;
    display: none;
    }
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
        <div class="container">
            <div class="navbar-header">
				<a class="navbar-brand" href="login.php">
					<img src="../../images/Cfc_Chennai_Logo.jpg" alt="Rechat HR Consulting" title="Rechat HR Consulting">        
				</a>
			</div>
            <div class="row">
                <div class="wrapper">
					<form class="form-signin" method="post" action="login.php">
					  <h2 class="form-signin-heading">CFC - Admin</h2>
					  <h2 class="form-signin-heading">Login </h2>
					  <input  id="emailid" type="text" class="form-control" name="user[emailid]" placeholder="Email" required="true" />
					  <span id="user-email"></span>
					  <br/>
					  <input id="password" type="password" class="form-control" name="user[userpassword]" placeholder="Password"  required="true"/>
					  <br/>
					  <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin" value="Login">Login</button>
					</form>
					 <div class="pull-right" style="padding-right: 320px;padding-bottom:120px"><a href="resetpassword.php">Forgotten Your Password</a></div>
				</div>
            </div>
           
        </div>
        <script src="../js/jQuery.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
    </body>
</html>
<?php if(isset($_POST['btnLogin']))
{
			$tablename="user";
		        $usermailid=$_POST['user']['emailid'];
			$userpassword=md5($_POST['user']['userpassword']);
			$userMailid = array("user_email"=>$usermailid);
			$fetch=$obj->fetch($tablename, $userMailid);
			if(count($fetch)>0)
			{
				
				switch ($fetch['0']['status']) 
				{
					case 0:
						echo "Dear User Kindly activate to login to our application";
						break;
				
					case 1:
						$InsColumnVal = array("user_email"=>$usermailid,"user_password"=>$userpassword,"status"=>1);
						$fetchemail=$obj->fetch($tablename, $InsColumnVal);
						
						if(count($fetchemail)>0)
						{
							session_start();
				 			$_SESSION["loginid"]=$fetch['0']['user_email'];
							
							
							
						    header("location:dashboard.php");
						}
						else if(count($fetchemail)=="0")
						{
							die('<img src="../img/not-available.png" />'.'The password that you entered did not match our records. Please double-check and try again.');
						}
					default:
						;
						break;
				}
			}
			else if(count($fetch)=="0")
			{
				die('<img src="../img/not-available.png" />'.'Sorry We have found that you have not rgistered with us.');
			}
			
			
			
			
}?>
