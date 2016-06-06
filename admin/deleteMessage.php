<?php 
include("../config/Class.Crud.Php");
session_start();
if($_SESSION['loginid']=="")
{
	header("location:login.php?msg=userinvalid");
}
$id=$_GET['id'];
$tablename="messagelist";
$condition = array("id"=>$id);
$obj->delete($tablename,$condition);
header("location:listmessages.php");
 ?>
