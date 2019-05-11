
<?php
include_once('header.php');
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

//fetching data
$result = $handler->query("SELECT * FROM users WHERE id=$id ");

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
    
    <title>Profile.PHP</title>

</head>
<body  id="body" class="dark-light">

<div class="container-fluid bg-primary">
    <h3>USERS PAGE</h3>
</div>


<div class="hero">

<div class="row d-flex flex-column align-items-center col-6">

    <hr>
    <a href="index.php" class="btn btn-secondary ml-1" role="button" >GO BACK</a>
	<br>
	<hr/>

    <table width='100%' border=0 class = "d-flex flex-column align-items-center table-bordered p-1">
        <thead class="thead-info bg-light m-1">
            <tr class="bg-primary text-white">
                <td>Id</td>
                <td>Username</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Email-Addres</td>
                <td>Active 0/1</td>
            </tr>
        </thead>
    </table>

    <div class="card-columns row d-flex flex-column align-items-center col-10">

        <div class="card bg-primary p-3 text-center">
        <h3 class="card-header">Hierna vind je mijn aanmeldingsgegevens:</h3>
        </div>

        <div class="card">
        <img class="card-img" src="class.jpg" alt="Card image" width="auto" height="180px">
            <div class="card-img-overlay">
            <p class="card-text text-success">
            
            <?php   
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
                echo "<td>". "ID-nr: " .$row['id']. "<br>" . "</td>";
                echo "<td>". "Username: " .$row['username']. "<br>" . "</td>";
                echo "<td>". "Firstname: " .$row['firstname']. "<br>" . "</td>";
                echo "<td>". "Lastname: " .$row['lastname']. "<br>" . "</td>";
                echo "<td>". "E-mail: " .$row['emailaddress']. "<br>" . "</td>";
                echo "<td>". "Active 0/1: " .$row['active']."</td>";	
                echo "</tr>";
                }
            ?>
            
            </p>
            </div>
        </div>

        <div class="card bg-primary p-3 text-center">
        <h3 class="card-header">***</h3>
        </div>

        <div class="card">
        <img class="card-img" src="class.jpg" alt="Card image">
            <div class="card-img-overlay">
            <p class="card-text"></p>
            </div>
        </div>

        <div class="card bg-primary p-3 text-center">
        <h3 class="card-header">***</h3>
        </div>

    </div>


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

