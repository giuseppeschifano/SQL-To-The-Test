
<?php
include_once('header.php');

//fetching data in descending order 
$result = $handler->query("SELECT * FROM users ORDER BY username ASC");
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    
    <title>Account.PHP</title>

</head>
<body>

<div class="container-fluid bg-primary">
    <h3>USERS PAGE</h3>
</div>


<div class="hero">

<!-- <div class="row d-flex flex-column"> -->

    <hr>
    <a href="index.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>
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
            <td>Edit | Delete</td>

        </tr>
	
        <?php   
        
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
                    
                echo "<tr>";
                echo "<td>". "&nbsp" .$row['id']."</td>";
                echo "<td>". "&nbsp" .$row['username']."</td>";
                echo "<td>". "&nbsp" .$row['firstname']."</td>";
                echo "<td>". "&nbsp" .$row['lastname']."</td>";
                echo "<td>". "&nbsp" .$row['emailaddress']."</td>";
                echo "<td>". "&nbsp" .$row['active']."</td>";

                
                echo "<td>
                        <a href=\"account.php?id=$row[id]\">Edit</a> | 
                        <a href=\"delete.php?id=$row[id]\" 
                        onClick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                     </td>";	
                echo "</tr>";
            }
        ?>

    </thead>
    </table>

    <div class = "d-flex flex-column align-items-center">
        <hr>
        <a href="register.php"  class="btn btn-success " role="button">ADD NEW USERS</a>
        <br>
        <hr>
    </div>

</div>  


</body>
</html>




