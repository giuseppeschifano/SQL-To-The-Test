
<?php
//including the database connection file
include_once("header.php");
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Start the session parametersxz
session_start();

	$_SESSION['login_time'] = time();

// die(print_r($_SESSION));

	$myusername = $_POST['user'];
	$mypassword = $_POST['pass'];
	

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);

	$result = $handler->query("SELECT * FROM users WHERE username='$myusername' ");
	
	$count = $result->fetch();
	$result->execute([$myusername]);
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		$_SESSION['id_user']=$row['id'];
	}


	if ($count > 0) {
		$hashed_password = $count['password'];

			if (password_verify($mypassword, $hashed_password)) {

				$seconds = 5 + time();
				setcookie(loggedin, date("F jS - g:i a"), $seconds);

				$_SESSION['login_user']=$myusername;
				header("location:home.php");

			} else {
				$_SESSION['errorPWD'] = '*** Username OK, but Password Incorrect !';
				header('Location: index.php');
			}
		} else {
				$_SESSION['errorUSER'] = '*** Username Incorrect, Try Again  !';
				header('Location: index.php');
	}


?>
