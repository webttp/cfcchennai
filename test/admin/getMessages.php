<?php
include("../config/Class.Crud.Php");
$tablename="messagelist";
if(($_GET['action']=="start") || ($_GET['action']=="locate" && $_GET['location']=='CFC-both')) 
{
			$userMailid = array("");
			$fetch=$obj->fetch($tablename, $userMailid);
			# JSON-encode the response
			$json_response = json_encode($fetch);
			// # Return the response
			echo $json_response;
}
else if($_GET['action']=="locate" && $_GET['location']!='')
{
			
			$userMailid = array("location"=>$_GET['location']);
			$fetch=$obj->fetch($tablename, $userMailid);
			# JSON-encode the response
			$json_response = json_encode($fetch);
			// # Return the response
			echo $json_response;
}
	
?>
