<?php
include("../config/Class.Crud.Php");
$tablename="messagelist";
if(($_GET['action']=="start") || ($_GET['action']=="locate" && $_GET['location']=='CFC-both')) 
{
			$condition = array("");
			$ordercol="uploadeddate";
			$fetch=$obj->fetchorderby($tablename, $condition,$ordercol);
			# JSON-encode the response
			$json_response = json_encode($fetch);
			// # Return the response
			echo $json_response;
}
else if($_GET['action']=="locate" && $_GET['location']!='')
{
			
			$condition = array("location"=>$_GET['location']);
			$ordercol="uploadeddate";
			$fetch=$obj->fetchorderby($tablename, $condition, $ordercol);
			# JSON-encode the response
			$json_response = json_encode($fetch);
			// # Return the response
			echo $json_response;
}
else if($_GET['action']=="edit")
{
			$id=$_GET['id'];
			$messageid = array("id"=>$id);
			$fetch=$obj->fetch($tablename, $messageid);
			$spartstext = explode('-', $fetch['0']['date']);
			$sdatetext  = "$spartstext[1]/$spartstext[2]/$spartstext[0]";
			$speakerarray=array("Prakasam","Micheal","Jesudoss","Johnrajan");
			if(in_array($fetch['0']['speaker'],$speakerarray)){
				$speaker=$fetch['0']['speaker'];
			}
			else{
				$speaker="others";
				$speakerother=$fetch['0']['speaker'];
			}
			$messagetype=$fetch['0']['messagetype'];
			$videokey="";
			$audiokey="";
			$speakerother="";
			switch($messagetype)
				{
					case 'audio':
					$audiokey=$fetch['0']['audiokey'];
					break;
					case 'video':
					$videokey=$fetch['0']['videokey'];
					break;
					case 'both':
					$videokey=$fetch['0']['videokey'];
					$audiokey=$fetch['0']['audiokey'];
					break;
					
				}
			$finalarray = array("messagedate"=>$sdatetext,"churchlocation"=>$fetch['0']['location'],"messagetitle"=>$fetch['0']['title'],"speakerchennai"=>$speaker,"speakerother"=>$speakerother,"messagetype"=>$messagetype,"videotype"=>$videokey,"audiotype"=>$audiokey);
			//$fetch=$obj->fetch($tablename, $messageid);
			$json_response = json_encode($finalarray);
			// # Return the response
			echo $json_response;
}	
?>
