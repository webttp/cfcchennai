<?php
include("../config/Class.Crud.Php");
$tablename="imagegallery";
			$userMailid = array("");
			$fetch=$obj->fetchorderby($tablename, $userMailid);
			# JSON-encode the response
			$json_response = json_encode($fetch);
			// # Return the response
			echo $json_response;

	
?>
