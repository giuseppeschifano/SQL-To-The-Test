
<?php
require_once 'header.php';
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php

// checking PWD fields
if(empty($pass) || empty($pwdconfirm) || empty($user) || ( (!empty($pass)) != (!empty($pwdconfirm))) ) {    
            
        if(empty($user)) {
            echo "<font color='red'>User field is empty.</font><br/>";
        } 
        if(empty($pass)) {
            echo "<font color='red'>New Password field is empty.</font><br/>";
        }
        if(empty($pwdconfirm)) {
            echo "<font color='red'>Confirm Password field is empty.</font><br/>";
        } 
        if((!empty($pass)) != (!empty($pwdconfirm))) {
            echo "<align='center' ><font color='red'>Confirm Password Does Not Match Password field.</font><br/>";
        }

    if( isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['pwdconfirm']) &&  ($_POST['pass'] = $_POST['pwdconfirm']) ) {

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

            header("location:index2.php");
            
		}
    }
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
<h3>REGISTER NEW USERS</h3>
</div>

<div class="hero">

    <br>
    <a href="index2.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>
	<br>
	<hr/>


    <div class = "row d-flex flex-column">

        <form action="register.php" method="POST" class = "d-flex flex-column align-items-center">

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
        <input type="submit" value="ADD USER" class="btn btn-primary"/>
        </div>
        
        </form>
    </div>

</div>

</body>
</html>

