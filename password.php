
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

    // checking PWD fields
    if(empty($pass) || empty($conf)) {    

        if(empty($pass)) {
            echo "<font color='red'>New Password field is empty.</font><br/>";
        }
        if(empty($conf)) {
            echo "<font color='red'>Confirm Password field is empty.</font><br/>";
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

        echo "<p align='center' > <font color='green'>New Password changed successfully.";
        echo "<br/> <p align='center' > <a href='index.php' >GO TO START PAGE</a>";
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="extra.css"/>

    <title>Password_PHP</title>

</head>

<body>
   
<div class="container-fluid bg-primary">
    <h3> PASSWORD PAGE </h3>

    <?php
        if (isset($_SESSION['login_user'])) {
        echo "<p align='center' > <font color='black' size='3pt'>changing password for username " . $_SESSION['login_user'] . " - idnr " . $_SESSION['id_user'] . "<br>";
        }
    ?>

    <br>
</div>

<div class="hero">

    <br>
    <a href="index.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>
	<br>
	<hr/>


    <div class = "row d-flex flex-column align-items-center">

        <form action="password.php" method="POST" class = "d-flex flex-column align-items-center">

        <table class="table-bordered">
        
            <tr> 
                <td class="bg-light pl-2 ">id</td>
                <td><input type="text" name="id" readonly class="form-control-plaintext  
                bg-light pl-2" value="<?php echo $id;?>"></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">username</td>
                <td><input type="text" name="username" readonly class="form-control-plaintext  
                bg-light pl-2" value="<?php echo $user;?>"></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">password</td>
                <td><input type="password" class="bg-warning pl-2" name="newpass" value=""></td>
            </tr>

            <tr> 
                <td class="bg-light pl-2">password</td>
                <td><input type="password" class="bg-warning pl-2" name="newconf" value=""></td>
            </tr>

        </table>

        <div class="form-group m-2 ">
        <input type="submit" name="update" value="UPDATE" class="btn btn-primary"/>
        </div>
        
        </form>

    </div>
</div>

</body>
</html>


<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>



