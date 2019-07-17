
<?php
    require_once 'header.php';
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
	$sett1=$_POST['settings1'];


	// checking empty fields
	if(empty($sett1)) {

		echo "<font color='orange'> the settings1 field is empty.</font><br/>";

	} else { 	

		$query = $handler->prepare("SELECT * FROM settings WHERE users_id='$id' "); 


		$query->execute([$id]);
		$idX = $query->fetchColumn();

		//check if there is already an entry for that id 

		if($idX) {

			echo "<p align='center' class='alert-info'> <font color='orange' size='4pt'> Record in Settings Table exists !";

        } else {   

            $query = $handler->prepare("INSERT INTO settings(users_id) VALUES ('$id') ");

            $query->execute();
            
            $_SESSION['message'] = "Record Settings Has Been Added !";
            $_SESSION['msg_type'] = "success";

		}

        //updating the tables

        $sql = ("UPDATE users TBL1  LEFT JOIN settings TBL2 ON TBL1.id = TBL2.users_id SET TBL1.username=:username, TBL2.settings1=:settings1  WHERE TBL1.id=:id");
        
        $query = $handler->prepare($sql);
                
        $query->bindparam(':id', $id);
        $query->bindparam(':username', $user);
        $query->bindparam(':settings1', $sett1);

        $query->execute();
    
        //display success message

        $_SESSION['message'] = "Record has been changed successfully !";
        $_SESSION['msg_type'] = "info";

        echo "<p align='center' class='bg-warning' > <font color='green'>To See Changes Click View Result Button.";

        echo "<br/> <p align='center' > <a class='btn btn-success' href='index2.php' >View Result</a>";
    }
}



// getting id from url
if(isset($_GET['id'])) {
	$id = $_GET['id']; 
}


//selecting data associated with this particular id

$sql = "SELECT  TBL1.id, TBL1.username, TBL2.settings1 FROM users TBL1 LEFT JOIN settings TBL2 ON TBL1.id = TBL2.users_id WHERE TBL1.id=:id";

$query = $handler->prepare($sql);

$query->execute(array(':id' => $id));


while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $id = $row['id'];
    $user = $row['username'];
    $sett1 = $row['settings1'];
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
	
	<title>Settings.PHP</title>
	
</head>	
<body>


<div class="container-fluid bg-primary p-2">
    <h3>SETTINGS PAGE</h3>

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
	<hr class="bg-white">
	
	<div class = "row d-flex flex-column align-items-center">

		<form action="settings.php" method="POST" class = "d-flex flex-column align-items-center p-3">

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
                    <td class="bg-light pl-2">settings1</td>
                    <td><input type="tinyint" class="bg-light pl-2" name="settings1" value="<?php echo $sett1;?>"></td>
                </tr>

                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                    
                    <td><input type="submit" class="btn btn-primary m-3" role="button" name="update" value="UPDATE" ></td>                
                </tr>

            </table>
        </form>
    </div>
</div>


    <!--Bootstrap & Jquery scripts-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--Axios script-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!--Your script-->
    <!-- <script src="script.js"></script> -->

</body>
</html>



