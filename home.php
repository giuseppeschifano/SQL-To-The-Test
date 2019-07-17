
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


	<!-- if(!isset($_COOKIE['loggedin'])){
		header("location:index2.php");
	} -->



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >


	<link rel="stylesheet" href="extra.css"/>
	
	<title>Home.PHP</title>
	
</head>
<body>


<div class="container-fluid bg-primary p-2">
    <h3>HOME PAGE</h3>
 
	<?php
		if (isset($_SESSION['login_user'])) {
		echo "<h4 align='center' > <font color='white'  weight:'bolder' >Welcome, " . $_SESSION['login_user'] . "<br>";
		}
	?>

</div>


<div class="hero bg-secondary">

	<br>
	<a href="index.php" class="btn btn-light ml-5" role="button" >GO BACK</a>
	<br>
	<hr class="bg-white">


	<!--  om session parameters door te geven, geen <div> gebruiken maar echo...!! -->


	<?php

	echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-success form-control col-2 m-2' href=\"index2.php\">GO TO USERS PAGE</a>";

	echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-primary form-control col-2 m-2' href=\"index3.php\">GO TO ADDRESS PAGE</a>";

	echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-warning form-control col-2 m-2' href=\"settings.php?id=$id\">GO TO SETTINGS PAGE</a>";

	echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-info form-control col-2 m-2' href=\"profile.php?id=$id\">GO TO PROFILE PAGE</a>";

	echo "<p align='center' > <font color='white' size='3pt'><a input type='button' style='margin:2px' class='btn btn-danger form-control col-2 m-2 mb-5' href=\"password.php?id=$id\">CHANGE PASSWORD</a>";

	?>

	<br>

</div>


</body>
</html>



