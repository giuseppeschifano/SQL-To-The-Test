
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

if(isset($_POST['update']))
{    
    $id=$_POST['id'];
    $user=$_POST['username'];
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];  
    $addr=$_POST['address'];
    $addr_nr=$_POST['address_nr'];
    $addr_box=$_POST['address_box'];
    $zip=$_POST['zipcode'];
    $cty=$_POST['city'];
    $ctry=$_POST['country'];
    $email=$_POST['emailaddress'];
    $act=$_POST['active'];
    $sett1=$_POST['settings1'];

    // checking empty fields
    if(empty($user) || empty($first) || empty($last)) {    
            
        if(empty($user)) {
            echo "<h5 align='center' class='alert-info'><font color='blue'>Username field is empty - </font>";
        } 
        if(empty($first)) {
            echo "<a align='center' class='alert-info'><font color='blue'>Firstname field is empty - </font>";
        }
        if(empty($last)) {
            echo "<a align='center' class='alert-info'><font color='blue'>Lastname field is empty.</font><br/>";
        } 

    } else {    

        $query = $handler->prepare("SELECT * FROM settings WHERE users_id='$id' ");

        $query->execute([$id]);
        $idX = $query->fetchColumn();

        //check if there is an entry for that id nr

        if($idX) {
                    
            echo "<p align='center' class='alert-info'> <font color='orange' size='4pt'> Record in Settings Table exists !";

        } else {   

            $query = $handler->prepare("INSERT INTO settings(users_id) VALUES ('$id') ");

            $query->execute();
            
            $_SESSION['message'] = "Record Settings Has Been Added !";
            $_SESSION['msg_type'] = "success";

            // header("location:account.php");
        }

        //updating the tables

        $sql = "UPDATE users TBL1  LEFT JOIN settings TBL2 ON TBL1.id = TBL2.users_id SET TBL1.username=:username, TBL1.firstname=:firstname, TBL1.lastname=:lastname, TBL1.address=:address, TBL1.address_nr=:address_nr, TBL1.address_box=:address_box, TBL1.zipcode=:zipcode, TBL1.city=:city, TBL1.country=:country, TBL1.emailaddress=:emailaddress, TBL1.active=:active, TBL2.settings1=:settings1  WHERE TBL1.id=:id";
        
        $query = $handler->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':username', $user);
        $query->bindparam(':firstname', $first);
        $query->bindparam(':lastname', $last);
        $query->bindparam(':address', $addr);
        $query->bindparam(':address_nr', $addr_nr);
        $query->bindparam(':address_box', $addr_box);
        $query->bindparam(':zipcode', $zip);
        $query->bindparam(':city', $cty);
        $query->bindparam(':country', $ctry);
        $query->bindparam(':emailaddress', $email);
        $query->bindparam(':active', $act);
        $query->bindparam(':settings1', $sett1);

        $query->execute();
    
        //display success message

        $_SESSION['message'] = "Record has been changed successfully !";
        $_SESSION['msg_type'] = "info";

        echo "<p align='center' class='bg-warning' > <font color='green'>To See Changes Click View Result Button.";

        echo "<br/> <p align='center' > <a class='btn btn-success' href='index2.php' >View Result</a>";




        //INSERT INTO table ADRESSEN (historiek adressen) !!

        $query = $handler->prepare("SELECT * FROM adressen WHERE users_id='$id' "); 

        $query = $handler->prepare("INSERT INTO adressen ( address_id, address, address_nr, address_box, zipcode, city, country ) VALUES ('$id', '$addr', '$addr_nr', '$addr_box', '$zip', '$cty', '$ctry') ");

        // $query = $handler->prepare($sql);
                
        // $query->bindparam(':id', $id);
        // $query->bindparam(':username', $user);
        // $query->bindparam(':firstname', $first);
        // $query->bindparam(':lastname', $last);
        // $query->bindparam(':address', $addr);
        // $query->bindparam(':address_nr', $addr_nr);
        // $query->bindparam(':address_box', $addr_box);
        // $query->bindparam(':zipcode', $zip);
        // $query->bindparam(':city', $cty);
        // $query->bindparam(':country', $ctry);
        // $query->bindparam(':emailaddress', $email);
        // $query->bindparam(':active', $act);
        // $query->bindparam(':settings1', $sett1);

        $query->execute();

    }

} 

// if((time() - $_SESSION['login_time']) > 300) {

//     // after 300 seconds inactivity delete user, after 300 sec deactivate user
//     $id = $_GET['id'];

//     //deleting the row from table
//     $sql = ( "DELETE FROM users WHERE id=:id");
//     $query = $handler->prepare($sql);
//     $query->execute(array(':id' => $id));
    
//     //redirecting
//     header("Location:index.php");

//     } else if((time() - $_SESSION['login_time']) > 90) {

//         //updating the table
//         $act = 0;

//         $sql = "UPDATE users SET active = $act  WHERE id=:id";
//         $query = $handler->prepare($sql);
//         $query->execute();

//         header("Location:index.php");
//         echo '<script language="javascript">';
//         echo 'alert(Your user-id will be deactivated in 90 sec / deleted in 5 min !! )';
//         echo '</script>';
//         exit;
// }


//getting id from url

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

//selecting data associated with this particular id

$sql = "SELECT  TBL1.id, TBL1.username, TBL1.firstname, TBL1.lastname, TBL1.address, TBL1.address_nr, TBL1.address_box, TBL1.zipcode, TBL1.city, TBL1.country, TBL1.emailaddress, TBL1.active, TBL2.settings1 FROM users TBL1 LEFT JOIN settings TBL2 ON TBL1.id = TBL2.users_id WHERE TBL1.id=:id";

$query = $handler->prepare($sql);

$query->execute(array(':id' => $id));


while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $id = $row['id'];
    $user = $row['username'];
    $first = $row['firstname'];
    $last = $row['lastname'];
    $addr = $row['address'];
    $addr_nr = $row['address_nr'];
    $addr_box = $row['address_box'];
    $zip = $row['zipcode'];
    $cty = $row['city'];
    $ctry = $row['country'];
    $email = $row['emailaddress'];
    $act = $row['active'];
    $sett1 = $row['settings1'];
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

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    
    <title>Account.PHP</title>

</head>
<body>


<div class="container-fluid bg-primary p-2">
    <h3>ACCOUNT PAGE</h3>
    <?php
		if (isset($_SESSION['login_user'])) {
		echo "<h4 align='center' > <font color='white' weight:'bolder' >User logged in: " . $_SESSION['login_user'] . "<br>";
		}
	?>
</div>

    
<div class="hero bg-secondary">
    <br>
    <a href="index2.php" class="btn btn-light ml-5" role="button" >GO BACK</a>
    <br>
    <hr class="bg-white">


    <form name="form1" method="POST" class = "d-flex flex-column align-items-center p-3" action="account.php">

        <table class="table-bordered text-secondary font-weight-bolder">
        
            <tr> 
                <td class="bg-warning pl-2 ">id</td>
                <td><input type="text" name="id" readonly class="form-control-plaintext  
                bg-warning" value="<?php echo $id;?>"></td>
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
                <td class="bg-light pl-2">address</td>
                <td><input type="text" name="address" value="<?php echo $addr;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">address_nr</td>
                <td><input type="text" name="address_nr" value="<?php echo $addr_nr;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">address_box</td>
                <td><input type="text" name="address_box" value="<?php echo $addr_box;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">zipcode</td>
                <td><input type="text" name="zipcode" value="<?php echo $zip;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">city</td>
                <td><input type="text" name="city" value="<?php echo $cty;?>"></td>
            </tr>
            <tr> 
                <td class="bg-light pl-2">country</td>
                <td><input type="text" name="country" value="<?php echo $ctry;?>"></td>
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
                <td class="bg-light pl-2">settings_1</td>
                <td><input type="tinyint" name="settings1" value="<?php echo $sett1;?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                
                <td><input type="submit" class="btn btn-primary m-3" role="button" name="update" value="UPDATE" ></td>                
            </tr>
            
        </table>
    </form>

</div>

</body>
</html>
