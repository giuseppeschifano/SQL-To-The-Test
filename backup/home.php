
<?php
    require_once 'header.php';
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();
$name = $_SESSION['login_user'];
$id = $_SESSION['id_user'];
?>

<?php
	if(!isset($_COOKIE['loggedin'])){
		header("location:settings.php");
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

	<link rel="stylesheet" href="extra.css"/>
	
	<title>Register_PHP</title>
	
</head>

<body>

<div class="container-fluid bg-primary">
<br>

<?php
	if (isset($_SESSION['login_user'])) {
	echo "<p align='center' > <font color='orange' size='5pt' weight:'bolder' >Welcome, " . $_SESSION['login_user'] . "<br>";
	}
?>

<br>
</div>

	<div class="hero">

		<br>
		<a href="index.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>

		<a href="index2.php"  class="btn btn-success" role="button">GO TO USERS PAGE</a>

		<!--  om session parameters door te geven, geen <div> gebruiken maar echo...!! -->

		<?php

		echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-warning form-control col-2 m-2' href=\"settings.php?id=$id\">GO TO SETTINGS</a>";

		echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-secondary form-control col-2 m-2' href=\"profile.php?id=$id\">GO TO PROFILE PAGE</a>";

		echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-danger form-control col-2 m-2' href=\"password.php?id=$id\">CHANGE PASSWORD</a>";

		?>

		<br>

	</div>


</body>
</html>



