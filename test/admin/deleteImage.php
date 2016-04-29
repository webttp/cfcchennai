<?php 
include("../config/Class.Crud.Php");
session_start();
if($_SESSION['loginid']=="")
{
	header("location:login.php?msg=userinvalid");
}
$imgid=$_GET['id'];

$tablename="imagegallery";

$condition = array("imgid"=>$imgid);

$fetch=$obj->fetch($tablename, $condition);

unlink("imagebank/".$fetch['0']['imgsrc']);
unlink("imagebank/thumbnail/".$fetch['0']['imgsrc']);


$obj->delete($tablename,$condition);
header("location:listimages.php");
 ?>
