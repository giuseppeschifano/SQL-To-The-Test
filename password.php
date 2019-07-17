
<?php
//including the database connection file
include_once("header.php");
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
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>


<?php

// getting id from url
if(isset($_GET['id'])) {
    $id = $_GET['id'];  
}

if(isset($_POST['newpass']))
{   
    $id=$_POST['id'];
    $user=$_POST['username'];
    $pass=$_POST['newpass'];
    $conf=$_POST['newconf'];

    // checking empty fields
    if(empty($pass) || empty($conf)) {    

        if(empty($pass)) {
            echo "<h5 align='center' class='alert-info'><font color='blue'>New Password field is empty - </font>";
        }
        if(empty($conf)) {
            echo "<a align='center' class='alert-info'><font color='blue'> Confirm Password field is empty.</font><br/>";
        } 

        } else {    

        //updating the table

        $nwpass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password='$nwpass' WHERE id=:id ";

        $query = $handler->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':username', $user);

        $query->execute(array(':id' => $id));


        //display success message
         
        $_SESSION['message'] = "Password changed successfully !";
        $_SESSION['msg_type'] = "success";

        echo "<p align='center' > <font color='green'>New Password changed successfully.";

        echo "<br/> <p align='center' > <a class='btn btn-success' href='home.php' >GO TO HOME PAGE</a>";
    }
}


//selecting data associated with this particular id

$sql = "SELECT * FROM users WHERE id=:id";
$query = $handler->prepare($sql); 
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $id = $row['id'];
    $user = $row['username'];
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

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

    <link rel="stylesheet" href="extra.css"/>

    <title>Password_PHP</title>

</head>
<body>
   
<div class="container-fluid bg-primary p-2">
    <h3> PASSWORD PAGE </h3>

    <?php
        if (isset($_SESSION['login_user'])) {
        echo "<h4 align='center' > <font color='white' weight:'bolder' >User logged in: " . $_SESSION['login_user'] . " - idnr " . $_SESSION['id_user'] . "<br>";
        }
    ?>

</div>

<div class="hero bg-secondary">

    <br>
    <a href="home.php" class="btn btn-light ml-5" role="button" >GO BACK</a>
	<br>
	<hr class="bg-white">


    <div class = "row d-flex flex-column align-items-center">

        <form action="password.php" method="POST" class = "d-flex flex-column align-items-center p-3">

        <table class="table-bordered text-secondary font-weight-bolder">
        
            <tr> 
                <td class="bg-warning pl-2 ">id</td>
                <td><input type="text" name="id" readonly class="form-control-plaintext  
                bg-warning pl-2" value="<?php echo $id;?>"></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">username</td>
                <td><input type="text" name="username" readonly class="form-control-plaintext  
                bg-light pl-2" value="<?php echo $user;?>"></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">password</td>
                <td><input type="password" class="bg-light pl-2" name="newpass" value=""></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">password</td>
                <td><input type="password" class="bg-light pl-2" name="newconf" value=""></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                
                <td><input type="submit" class="btn btn-primary m-3" role="button" name="update" value="UPDATE" ></td>                
            </tr>

        </table>

        <!-- <div class="form-group m-2 ">
        <input type="submit" name="update" value="UPDATE" class="btn btn-primary"/>
        </div> -->
        
        </form>

    </div>
</div>

</body>
</html>


<!-- // remove all session variables -->
<!-- session_unset();  -->

<!-- // destroy the session  -->
<!-- session_destroy();  -->

