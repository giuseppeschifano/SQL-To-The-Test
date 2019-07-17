
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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" > 

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" >


    <link rel="stylesheet" href="extra.css"/>
    
    <title>Index2.PHP</title>

</head>
<body>


<div class="container-fluid bg-primary p-2">
    <h3>USERS PAGE</h3>

    <?php
		if (isset($_SESSION['login_user'])) {
		echo "<h4 align='center' > <font color='white' weight:'bolder' >User logged in: " . $_SESSION['login_user'] . "<br>";
		}
	?>
</div>


<div class="hero bg-secondary">
    <br>
    <a href="home.php" class="btn btn-light ml-5" role="button" >GO BACK</a>

    <!-- <div class="row d-flex justify-content-center ">
        <form class="col-2" action="index2.php" method="POST">
            <input class="text-secondary" type="text" name="start" placeholder="Value To Search">

            <input class="btn btn-success" type="submit" name="search" placeholder="Filter" value="Find">
        </form>
    </div> -->

    <br>  
    <br>
</div>


<div class="hero bg-secondary">
    <div>
    
    <table class = "d-flex flex-column table-sm align-items-center table-bordered col-12  p-3">
    <thead class="thead-info bg-white text-secondary m-1">

        <tr class="bg-primary text-secondary col-12">
            
            <th class="text-white p-2">Id</th>
            <th class="text-white p-2">Username</th>
            <th class="text-white p-2">Firstname</th>
            <th class="text-white p-2">Lastname</th>
            <th class="text-white p-2">address</th>
            <th class="text-white p-2">addr_nr</th>
            <th class="text-white p-2">addr_box</th>
            <th class="text-white p-2">zipcode</th>
            <th class="text-white p-2">city</th>
            <th class="text-white p-2">country</th>
            <th class="text-white p-2">Email-Addres</th>
            <th class="text-white p-2">Active</th>
            <th class="text-white p-2">Set_1</th>
            <th class="text-white p-2">Edit</th>
            <th class="text-white p-2">Delete</th>
            <th class="text-white p-2">Ch_PW</th>

        </tr>
	
        <?php   
            

            // if(isset($_POST['search'])){
            //     $start = $_POST['start'];
                
                $result = $handler->query("SELECT TBL1.id, TBL1.username, TBL1.firstname, TBL1.lastname, TBL1.address, TBL1.address_nr, TBL1.address_box, TBL1.zipcode, TBL1.city, TBL1.country, TBL1.emailaddress, TBL1.active, TBL2.settings1 FROM users TBL1 LEFT JOIN settings TBL2 ON TBL1.id = TBL2.users_id ORDER BY TBL1.firstname ASC");


                // WHERE TBL1.lastname LIKE '%:start%' OR TBL1.firstname LIKE '%:start%' 

                // $result->execute(array(':start'=>$start));

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    echo "<tr>";
                    echo "<td style='40px'>". "&nbsp" .$row['id']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['username']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['firstname']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['lastname']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['address']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['address_nr']."</td>";
                    echo "<td>". "&nbsp" .$row['address_box']."</td>";
                    echo "<td>". "&nbsp" .$row['zipcode']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['city']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['country']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['emailaddress']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['active']."</td>";
                    echo "<td style='40px'>". "&nbsp" .$row['settings1']."</td>";

                    // edit button
                    echo "<td>
                            <a input type='button'  class='btn btn-white  btn form-control align-item-center'  href=\"account.php?id=$row[id]\">&#x1F521;</a> </td>";

                    // delete button
                    echo "<td>
                            <a input type='button'  class='btn btn-warning  btn form-control align-item-center' href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete this record?')\">&#x274C;</a> </td>"; 

                    // change PW button
                    echo "<td>
                            <a input type='button'  class='btn btn-info  btn form-control align-item-center'  href=\"password.php?id=$row[id]\">&#x1F6E1;</a></td>";	
                    echo "</tr>";
                }
            // }   
        ?>

    </thead>
    </table>
    </div>

    <div class = "d-flex flex-column align-items-center">
        <hr>
        <a href="register.php"  class="btn btn-primary " role="button">ADD NEW USERS</a>
        <br>
        <hr>
    </div>

</div>  


</body>
</html>




