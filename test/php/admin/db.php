<?php
/*
$host      = "localhost"; 
    $user      = "root"; 
    $pass      = "PEG4VtRhaXHmTz7j"; 
    $database  = "shopping";
    $con       = mysql_connect($host,$user,$pass);
*/
  

    /*******************************/

/**  Switch Case to Get Action from controller  **/

/**  Function to Get Product  **/
switch($_GET['action'])  {
    case 'add_product' :
            add_product();
            break;

    case 'get_product' :
            get_product();
            break;

    case 'edit_product' :
            edit_product();
            break;

    case 'delete_product' :              
            delete_product();
            break;

    case 'update_product' :
            update_product();
            break;
}
function get_product() {   
 $servername = "localhost";
$username = "root";
$password = "PEG4VtRhaXHmTz7j";
$dbname = "shopping";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

   $sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   $arr = array(); 
	  
    
        while($row = $result->fetch_assoc()) { $arr[] = $row; }
   
    echo $json_response = json_encode($arr);
}
}



?>