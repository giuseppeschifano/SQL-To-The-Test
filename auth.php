
<?php

//including the database connection file
include_once("header.php");

// Start the session for error messages
session_start();

	$myusername = $_POST['user'];
	$mypassword = $_POST['pass'];

	// print_r($_POST);

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);

	// print_r($mypassword);
	
	$result = $handler->query("SELECT * FROM users WHERE username='$myusername'");
	$count = $result->fetch();

	$result->execute([$myusername]);
	$userY = $result->fetchColumn();


	if( $count>0) {

		$hashed_password = $count['password'];
	
			if (password_verify($mypassword, $hashed_password)) {

				$seconds = 5 + time();
				setcookie(loggedin, date("F jS - g:i a"), $seconds);

				$_SESSION["login_user"]=$myusername;
				
				header("location:home.php");
				
			} else {

				$_SESSION['errorPWD'] = '*** Username OK, but Password Incorrect !';
				header('Location: login.php');

				// echo "<p align='center' > <font color='red' size='4pt'>  *** Username OK, but Password Incorrect";
			}

		} else {

				$_SESSION['errorUSER'] = '*** Username Incorrect, Try Again  !';
				header('Location: login.php');
				
				// echo "<p align='center' > <font color='red' size='4pt'>  *** Username Unknown, Try Again ";
	}
	

?>
