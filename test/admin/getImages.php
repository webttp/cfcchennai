<?php
include("../config/Class.Crud.Php");
$tablename="imagegallery";
$condition = array("");
$ordercol="uploadeddate";
$fetch=$obj->fetchorderby($tablename, $condition,$ordercol);
# JSON-encode the response
$json_response = json_encode($fetch);
// # Return the response
echo $json_response;
?>
