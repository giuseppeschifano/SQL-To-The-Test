
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
    if (isset($_SESSION['message'])):
?>
    <div class="d-flex justify-content-center alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>



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
    
    <title>Index3_PHP</title>

</head>
<body>
   
<div class="container-fluid bg-primary p-2">
    <h3>LIST UPDATED ADDRESSES</h3>

    <?php
        if (isset($_SESSION['login_user'])) {
        echo "<h4 align='center' > <font color='white' weight:'bolder'>User logged in: " . $_SESSION['login_user'] . " - idnr " . $_SESSION['id_user'] . "<br>";
        }
    ?>
</div>


<div class="hero bg-secondary">
    <br>
    <a href="home.php" class="btn btn-light ml-5" role="button" >GO BACK</a>
	<br>
    <br>
</div>


<div class="hero bg-secondary">
    
    <div>

        <table width='100%' class = "d-flex flex-column table-sm table-bordered  align-items-center table-hover col-12 p-3">

            <thead class="thead-info bg-white text-secondary m-1">
        
                <tr class="bg-primary text-white col-12">
                    
                    <th class="p-2">Id</th>
                    <th class="p-2">Firstname</th>
                    <th class="p-2">Lastname</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Nr</th>
                    <th class="p-2">Box</th>
                    <th class="p-2">Zip</th>
                    <th class="p-2">City</th>
                    <th class="p-2">Country</th>
                    <th class="p-2">Updated_At_ &#x2B07;</th>
                </tr>
                    

                <?php
                    
                    $result = $handler->query("SELECT TBL1.id, TBL1.firstname, TBL1.lastname, TBL2.id, TBL2.address_id, TBL2.address, TBL2.address_nr, TBL2.address_box, TBL2.zipcode, TBL2.city, TBL2.country, TBL2.updated_at FROM users TBL1 LEFT JOIN adressen TBL2 ON TBL1.id = TBL2.address_id WHERE TBL2.updated_at > 0 ORDER BY TBL2.updated_at DESC");
                    
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
        
                        echo "<tr>";
                        echo "<td>". "&nbsp" .$row['address_id']."</td>";
                        echo "<td>". "&nbsp" .$row['firstname']."</td>";
                        echo "<td>". "&nbsp" .$row['lastname']."</td>";
                        echo "<td>". "&nbsp" .$row['address']."</td>";
                        echo "<td>". "&nbsp" .$row['address_nr']."</td>";
                        echo "<td>". "&nbsp" .$row['address_box']."</td>";
                        echo "<td>". "&nbsp" .$row['zipcode']."</td>";
                        echo "<td>". "&nbsp" .$row['city']."</td>";
                        echo "<td>". "&nbsp" .$row['country']."</td>";
                        echo "<td>". "&nbsp" .$row['updated_at']."</td>";
                        echo "</tr>";


                    }
                ?>
                
            </thead>
        </table>
    </div>

    <div class = "d-flex flex-column align-items-center">
        <hr>
        <!-- <a href="register.php"  class="btn btn-primary " role="button">ADD NEW USERS</a> -->
        <br>
        <hr>
    </div>



</div>


</body>
</html>

