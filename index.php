
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
    
    <title>Login.PHP</title>

</head>
<body id="body" class="dark-mode">


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
    
<h3>START PAGE</h3>

    <h5 class="text-center text-warning font-weight-bolder" >- - - If you already have an account SIGN IN, else SIGN UP - - -</h5>
    
    <div class="d-flex flex-column align-items-end mr-5">
        <a href="register2.php" class="btn btn-light " role="button">SIGN UP</a>
    </div>
    
    <br>
</div>

<div class="hero"> 

<div class="row d-flex flex-column">

    <form action="auth.php" method="POST" class = "d-flex flex-column align-items-center">

        <div class="input-group col-4 m-4">
        <div class="input-group-prepend">
        <button class="btn btn-success" type="button">Username</button>
        </div>
        <input type="text" class="form-control"  name="user" placeholder="Username" />
        </div>

        <div class="input-group col-4 m-3">
        <div class="input-group-prepend">
        <button class="btn btn-success" type="button">Password</button>
        </div>
        <input type="password" class="form-control" name="pass" />
        </div>

        <!-- <div class="input-group col-4 m-3">
        <div class="input-group-prepend">
        <button class="btn btn-success" type="button">New PWD</button>
        </div>
        <input type="password" class="form-control" name="chgpwd" />
        </div> -->
        
        <div class="form-group m-3"> 
        <label for="formGroupExampleInput"></label>
        <input type="submit" class="btn btn-primary" value="SIGN IN" />
        </div>

    </form>

</div>
</div>  

    <div id="bodyDL" class="d-flex flex-column align-items-center ">
    <br>
    <button class="btn btn-danger" onclick="myColorBody()">&#x262F;</button>
    </div>

    <!--Bootstrap & Jquery scripts-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--Axios script-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!--Your script-->
    <script src="script.js"></script>

</body>
</html>

