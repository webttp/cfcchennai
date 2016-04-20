<?php
include("../../resources/Class.Crud.Php");
$repassword=$_POST['user']['repassword'];
$conpassword=$_POST['user']['conpassword'];
if($repassword==$conpassword)
{
	
		$tablename="user";
		$userhidden=$_POST['user']['userhidden'];
		$set = array("user_password"=>md5($repassword));
		$condition = array("user_id"=>$userhidden,"status"=>'1');
		
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