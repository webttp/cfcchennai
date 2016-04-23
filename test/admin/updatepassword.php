<?php
include("../config/Class.Crud.Php");

$repassword=$_POST['user']['repassword'];
$conpassword=$_POST['user']['conpassword'];
if($repassword==$conpassword)
{
	
		$tablename="user";
		echo $userhidden=$_POST['user']['userhidden'];
		$set = array("user_password"=>md5($repassword));
		$condition = array("user_email"=>$userhidden,"status"=>'1');
		print_r($condition);
		$msg=$obj->update($tablename, $set,$condition);
		
		if($msg=="Record updated successfully")
		{
			header("location:dashboard.php");
		}
}
else
{
	$encrypt=$_POST['user']['encrypt'];
	header("location:resetpassword.php?encrypt=".$encrypt."&action=reset&password=notequal");
}