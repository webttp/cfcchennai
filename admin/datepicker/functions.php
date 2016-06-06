<?php
/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/

function checkUser(){

	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['plaincart_user_id'])) {
		header('Location:login.php');
		exit;
	}
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}
function doLogin(){
					
					// if we found an error save the error message in this variable
					$errorMessage = '';
					$txtuser='';
					$userName = $_POST['username'];
					$password = md5($_POST['password']);
					
					// first, make sure the username & password are not empty
					if ($userName == '') {
						$errorMessage = 'You must enter your username';
					} 
					else if ($password == '') {
						$errorMessage = 'You must enter the password';
					} 
					else {
						// check the database and see if the username and password combo do match
						
						$sql = "SELECT id
								FROM infoview_users 
								WHERE username = '$userName' AND password = '$password'";
								
						$result = dbQuery($sql);
					
						if (dbNumRows($result) == 1) {
							$row = dbFetchAssoc($result);
							$_SESSION['plaincart_user_id'] = $row['id'];
							
							// log the time when the user last login
							$sql = "UPDATE infoview_users 
									SET  lastlogin = NOW() 
									WHERE id = '{$row['id']}'";
							dbQuery($sql);
				
							
							header('Location: index.php');
							exit;
							
						} else {
							$errorMessage = 'Wrong username or password';
						}		
							
					}
					
					return $errorMessage;
}

/*
	Logout a user
*/
function doLogout()
{
	if (isset($_SESSION['plaincart_user_id'])) {
		unset($_SESSION['plaincart_user_id']);
		
	}
		
	header('Location: login.php');
	exit;
}
?>