
<?php
// including the database connection file
include_once("header.php");
?>

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<?php

if(isset($_POST['update']))
{    
    $id=$_POST['id'];
    $user=$_POST['username'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];  
    $email=$_POST['emailaddress'];
    $act=$_POST['active'];

    // checking empty fields
    if(empty($user) || empty($first) || empty($last)) {    
            
        if(empty($user)) {
            echo "<font color='red'>Username field is empty.</font><br/>";
        }
        if(empty($first)) {
            echo "<font color='red'>Firstname field is empty.</font><br/>";
        }
        if(empty($last)) {
            echo "<font color='red'>Lastname field is empty.</font><br/>";
        } 

    } else {    

        //updating the table

        $sql = "UPDATE users SET username=:username, firstname=:firstname, lastname=:lastname, emailaddress=:emailaddress, active=:active  WHERE id=:id";
        
        $query = $handler->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':username', $user);
        $query->bindparam(':firstname', $first);
        $query->bindparam(':lastname', $last);
        $query->bindparam(':emailaddress', $email);
        $query->bindparam(':active', $act);

        $query->execute();
    
        //display success message
        echo "<p align='center' > <font color='green'>Data changed successfully.";
        echo "<br/> <p align='center' > <a href='index2.php' >View Result</a>";
    }
}


//getting id from url

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}


//selecting data associated with this particular id

$sql = "SELECT * FROM users WHERE id=:id";
$query = $handler->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $id = $row['id'];
    $user = $row['username'];
    $first = $row['firstname'];
    $last = $row['lastname'];
    $email = $row['emailaddress'];
    $act = $row['active'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="extra.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <title>Account.PHP</title>

</head>
<body>

<div class="container-fluid bg-primary">
    <h3>UPDATE USERS</h3>
</div>

    
<div class="hero">

    <hr>
    <a href="index2.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>
    <br>
    <hr>

<!-- <div class="row d-flex flex-column" > -->


    <form name="form1" method="post" class = "d-flex flex-column align-items-center p-3" action="account.php">

        <table class="table-bordered">
        
            <tr> 
                <td class="bg-light pl-2 ">id</td>
                <td><input type="text" name="id" readonly class="form-control-plaintext  
                bg-light" value="<?php echo $id;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">username</td>
                <td><input type="text" name="username" value="<?php echo $user;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">firstname</td>
                <td><input type="text" name="firstname" value="<?php echo $first;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">lastname</td>
                <td><input type="text" name="lastname" value="<?php echo $last;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">e-mail addres</td>
                <td><input type="text" name="emailaddress" value="<?php echo $email;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">active 0/1</td>
                <td><input type="tinyint" name="active" value="<?php echo $act;?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                
                <td><input type="submit" class="btn btn-primary mt-5 ml-3" role="button" name="update" value="UPDATE" ></td>                
            </tr>
            
        </table>
    </form>



</div>

</body>
</html>
