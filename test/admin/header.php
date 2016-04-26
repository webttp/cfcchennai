<?php
session_start();
if($_SESSION['loginid']=="")
{
	header("location:login.php?msg=userinvalid");
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
    ul>li, a{cursor: pointer;}
    </style>
    <title>CFC - Admin</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"  />
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>	
	<nav class="navbar navbar-default">
	<div class="container-fluid">
    <div class="row">
	<div class="col-md-12">
	<span class="pull-left">
    <a  href="dashboard.php"><img src="../../images/Cfc_Chennai_Logo.jpg" alt="cfcchennai_logo"></a>
	</span>
	</div>
	    <div class="col-md-11"><span class="pull-right"><?php  echo 'Welcome   '. $_SESSION['loginid']; ?>
			<a href="logout.php">Logout</a>
			</span>
		</div>
	</div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php">Home</a></li>
      <li><a href="listmessages.php">Messages</a></li>
	  <li><a href="listimages.php">Images - Upload</a></li>
    </ul>
	</div>
	</nav>