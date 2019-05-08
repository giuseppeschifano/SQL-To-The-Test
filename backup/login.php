
<?php
require_once 'header.php';
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $message ="";
?>

<?php
session_start();
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
    <title>Login.PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>


<?php
if (isset($_SESSION['errorPWD'])) {
echo "<p align='center' > <font color='red' size='4pt'>ERROR: " . $_SESSION['errorPWD'] . "<br>";    
}
?>

<?php
if (isset($_SESSION['errorUSER'])) {
echo "<p align='center' > <font color='red' size='4pt'>ERROR: " . $_SESSION['errorUSER'] . "<br>";
}
?>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>



<div class="container-fluid bg-primary">
<h3>SIGN IN - SIGN UP</h3>
</div>


<div class="hero">
<div class="row d-flex flex-column">

    <form action="auth.php" method="POST" class = "d-flex flex-column align-items-center">

        <div class="form-group row m-3">   
        <label for="formGroupExampleInput">Username</label>
        <input type="text" class="form-control"  name="user" placeholder="Userid" />
        </div>

        <div class="form-group row m-3"> 
        <label for="formGroupExampleInput">Password</label>
        <input type="password" class="form-control" name="pass" />
        </div>
        
        <div class="form-group m-3"> 
        <label for="formGroupExampleInput"></label>
        <input type="submit" class="btn btn-primary" value="Sign In" />
        </div>

        <div class="form-group m-3">
        <label for="formGroupExampleInput"></label>
        <a href="register.php" class="btn btn-secondary" role="button">Sign Up</a>
        </div>


    </form>

</div>
</div>  

</body>
</html>

