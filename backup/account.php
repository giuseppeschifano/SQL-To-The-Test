
<?php

// including the database connection file
include_once("header.php");
 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['update']))
{    
    $id=$_POST['id'];
    $user=$_POST['username'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];  
    $email=$_POST['emailaddress'];
      

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

        $sql = "UPDATE users SET username=:username, firstname=:firstname, lastname=:lastname WHERE id=:id";
        $query = $handler->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':username', $user);
        $query->bindparam(':firstname', $first);
        $query->bindparam(':lastname', $last);
        $query->bindparam(':emailaddress', $email);

        $query->execute();
    
        //display success message
        echo "<font color='green'>Data changed successfully.";
        echo "<br/><a href='index.php'>View Result</a>";

        //redirecting to the display page. In our case, it is index.php
        //header("Location: index.php");
    }
}


//getting id 
$id = $_GET['id'];
 

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
    <title>Account.PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid bg-primary">
<h3>EDIT OR DELETE USERS</h3>
</div>
    
<div class="container">
<div class="row d-flex justify-content-center" >
    <hr>
    
    <a href="index.php" class="btn btn-primary ml-5" role="button" >Go Back</a>
    <br>
    <hr>
    
    <form name="form1" method="post" class = "d-flex flex-column align-items-center" action="account.php">
        <table border="0">
            <tr> 
                <td>username</td>
                <td><input type="text" name="username" value="<?php echo $user;?>"></td>
            </tr>
            <tr> 
                <td>firstname</td>
                <td><input type="text" name="firstname" value="<?php echo $first;?>"></td>
            </tr>
            <tr> 
                <td>lastname</td>
                <td><input type="text" name="lastname" value="<?php echo $last;?>"></td>
            </tr>
            <tr> 
                <td>e-mail addres</td>
                <td><input type="text" name="emailaddress" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>

</div>
</div>

</body>
</html>
