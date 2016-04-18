<?php
$servername = "bqmayq5x95g1sgr9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "cchnflwiwmucc12k";
$password = "aom0shz4do0uf1bi";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname = "rrbnvpvpvc79aytz");

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}