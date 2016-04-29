<?php
include("../config/Class.Crud.Php");
$tablename="imagegallery";
			$condition = array("");
			$ordercol="uploadeddate";
$fetch=$obj->fetchorderby($tablename, $condition,$ordercol);
print_r($fetch);
echo "getimwwwwwwwwwwwwwwwwwwwwwwages";
?>
