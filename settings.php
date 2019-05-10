
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

// getting id from url
if(isset($_GET['id'])) {
    $id = $_GET['id'];  
}

if(isset($_POST['update']))
{   
	$id=$_POST['id'];
	$user=$_POST['username'];
	$sett1=$_POST['settDL'];


	// checking fields
	if(empty($sett1)) {
		echo "<font color='white'>SettingDL field is empty.</font><br/>";

	} else { 	

		$sql = "SELECT * FROM settings WHERE id=:id";
		$query = $handler->prepare($sql); 

		$query->execute(array(':id' => $id));

		// $query->execute([$id]);

		$idX = $query->fetchColumn();

		//check if there is already an entry for that id 

		if($idX) {

			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				$id = $row['id'];
				$sett1 = $row['settingDL'];
			}

			 //updating the table settings
					 
			 $query->bindparam(':id', $id);
			 $query->bindparam(':settingDL', $sett1);
	 
			 $query->execute(array(':id' => $id));
	 
			 //display success message
	 
			 echo "<p align='center' > <font color='green'>SettingDL changed successfully.";
			 echo "<br/> <p align='center' > <a href='index.php' >GO TO START PAGE</a>";

		} else {

			$query = $handler->prepare("INSERT INTO settings(id, settingDL) VALUES ('$id', '$sett1')");
			$query->execute(array(':id'));

            header("location:settings.php");
		}
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
    
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    
    <link rel="stylesheet" href="extra.css"/>
	
	<title>Sessions_PHP</title>
	
</head>	

<body id="body" class="dark-mode">

<div class="container-fluid bg-primary">

<h3>SETTINGS PAGE</h3>

<?php
	if (isset($_SESSION['login_user'])) {
		echo "<p align='center' > <font color='white' size='4pt'>changing settings for username " . $_SESSION['login_user'] . " - idnr " . $_SESSION['id_user'] . "<br>";
	}
?>

<br>
</div>

	<div class="hero">

	<!-- <img src="class.jpg" id="img_set" /> -->

	<br>
	<a href="index.php" class="btn btn-secondary ml-5" role="button" >GO BACK</a>
	<br>
	<hr>
	
	<div class = "row d-flex flex-column align-items-center">

		<form action="settings.php" method="POST" class = "d-flex flex-column align-items-center">

		<table class="table-bordered">

			<tr> 
				<td class="bg-success pl-2 ">id</td>
				<td><input type="text" name="id" readonly class="form-control-plaintext  
				bg-success pl-2" value="<?php echo $id;?>"></td>
			</tr>

			<tr> 
				<td class="bg-success pl-2">username</td>
				<td><input type="text" name="username" readonly class="form-control-plaintext  
				bg-success pl-2" value="<?php echo $user;?>"></td>
			</tr>

			<tr> 
				<td class="bg-warning pl-2">setting1</td>
				<td><input type="tinyint" class="bg-warning pl-2" name="settDL" value="<?php echo $sett1;?>"></td>
			</tr>
		</table>

		<div class="form-group m-2 ">
        <input type="submit" name="update" value="UPDATE" class="btn btn-primary"/>
        </div>
        
        </form>

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



