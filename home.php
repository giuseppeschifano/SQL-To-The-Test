
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
?>

<?php
	if(!isset($_COOKIE['loggedin'])){
		header("location:login.php");
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="extra.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register_PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<div class="container-fluid bg-primary">

<h3></h3>

<?php
if (isset($_SESSION['login_user'])) {
echo "<p align='center' > <font color='white' size='5pt'>Welcome, " . $_SESSION['login_user'] . "<br>";
}
?>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>

</div>

	<div class="hero">
	<div class="row d-flex flex-column align-items-center">
	<div class="form-group m-3">
	<a href="login.php"  class="btn btn-secondary" role="button">Go Back</a>
	</div>
	</div>
	</div>

</body>
</html>

