
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
    if (isset($_SESSION['message'])):
?>
    <div class="d-flex justify-content-center alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>


<?php

// checking PWD fields
if(empty($pass) || empty($pwdconfirm) || empty($user) || ( (!empty($pass)) != (!empty($pwdconfirm))) ) {    
    
        if(empty($user)){
            echo "<h5 align='center' class='alert-info' ><font color='blue'>User field is empty - </font>";
        }
        if(empty($pass)) {
            echo "<a align='center' class='alert-info' ><font color='blue'>New Password field is empty - </font>";
        }
        if(empty($pwdconfirm)) {
            echo "<a align='center' class='alert-info' ><font color='blue'>Confirm Password field is empty - </font>";
        }  
        if((!empty($pass)) != (!empty($pwdconfirm))) {
            echo "<a align='center' class='alert-info' ><font color='blue'>Confirm Password Does Not Match Password field.</font><br/>";
        }

    if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pwdconfirm']) && ($_POST['pass'] = $_POST['pwdconfirm']) ){

        $user = $_POST['user'];
        $first = $_POST['firstname'];
        $last = $_POST['lastname'];
        $email = $_POST['emailaddress'];

        $pass = $_POST['pass'];
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $query = $handler->prepare("SELECT * FROM users WHERE username='$user'");
        
        $query->execute([$user]);
        $userX = $query->fetchColumn();

        //check if there is already an entry for that username
        
		if($userX) {
            echo "<p align='center' > <font color='red' size='4pt'> Username already exists !!";

		} else {
			$query = $handler->prepare("INSERT INTO users(username, firstname, lastname, emailaddress, password) VALUES ('$user', '$first', '$last', '$email', '$pass')");
            $query->execute();
            
            echo "<p align='center' > <font color='green' size='4pt'> Your Username Has Been Added !!";
            
            echo "<br/> <p align='center' > <a href='index.php' >Welcome</a>";

            // header("location:home.php"); => This gives error code: Too many redirects, clear cookies ...§
	    }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"  content="ie=edge">

    <link rel="stylesheet" href="extra.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    
    <title>Register2_PHP</title>
    
</head>
<body>
   

<div class="container-fluid bg-primary p-2">
    <h3>SIGN UP PAGE</h3>
    <?php
        
		echo "<h5 align='center' > <font color='white' weight:'bolder' >Welcome, " . "<br>";
	
	?>
</div>

<div class="hero bg-secondary">
    <br>
    <a href="index.php" class="d-flex justify-content-center align-item-left btn btn-light col-1 ml-5" role="button" >GO BACK</a>
	<!-- <br> -->
    <hr class="bg-white">
    <br>


    <div class="row d-flex justify-content-center bg-secondary col-12">

        <div class="card  d-flex flex-column justify-content-center  bg-secondary pt-3 col-6">
       
            <form action="register2.php" method="POST" class = "d-flex flex-column align-items-center">

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Username</button>
            </div>
            <input type="text" class="form-control" name="user"  placeholder="user name" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Firstname</button>
            </div>
            <input type="text" class="form-control" name="firstname"  placeholder="first name" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Lastname</button>
            </div>
            <input type="text" class="form-control" name="lastname"  placeholder="last name" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Email adr.</button>
            </div>
            <input type="text" class="form-control" name="emailaddress"  placeholder="e-mail address" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Password</button>
            </div>
            <input type="password" class="form-control" name="pass"  placeholder="password" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="input-group col-4 m-2">
            <div class="input-group-prepend">
            <button class="btn btn-success" type="button">Password</button>
            </div>
            <input type="password" class="form-control" name="pwdconfirm"  placeholder="confirm pwd" aria-label="" aria-describedby="basic-addon1">
            </div>


            <div class="form-group m-2">
            <input type="submit" value="SIGN UP" class="btn btn-primary" />
            </div>
            
            </form>
        </div>
    </div>
</div>

</body>
</html>

