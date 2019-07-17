
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

    <div class="alert alert-info align='center' <?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>

<?php endif ?>


<?php
    // getting id from url
    if(isset($_GET['id'])) {
        $id = $_GET['id']; 
    }


if(isset($_POST['submit']))
{
    // id nr
    $id=$_POST['id'];

    // image file name
    $name = $_FILES["file"]["name"];

    if(empty($name)) {
        echo "<h5 class='alert-info' align='center' font color='orange'> There is no image selected !<h5>";
    }


    // pad waarin zich de image bevindt
    $target_dir = "/var/www/html/extra/uploads/";

    // volledig pad + image naam
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // geeft file type v.d. image weer
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    if($imageFileType != 'jpg' || $imageFileType != 'jpeg' || $imageFileType != 'png' || $imageFileType != 'gif') {
        echo "<h5 class='alert-info' align='center' font color='orange'>Only jpg - jpeg - png - gif are allowed !<h5>";
    }


    // geeft array met de toegestane image extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    
    if( in_array($imageFileType,$extensions_arr) ){


        // Convert to base64 (geeft longtext v.d. image,bijv.: "/9j/4AAQSkZJRgABAQAASABIAAD/4QB+RXhpZgAATU0AKgAAAAgAAYdpAAQAA........)
        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );


        // volgende regel geeft:  "data:image/jpg;base64,/9j/4AAQSkZJRgABAQ.......
        $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;


        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    }

    // checking empty fields

    if(!empty($image)) {

        $query = $handler->prepare(" SELECT * FROM images WHERE images_id='$id' ");

        $query->execute([$id]);

        $idX = $query->fetchColumn();


        //check if there is already an entry for that id 

        if($idX) {


            //updating the tables

            $sql = "UPDATE users TBL1  LEFT JOIN images TBL2 ON TBL1.id = TBL2.images_id SET TBL2.images_id=:id, TBL2.name=:name, TBL2.image=:image  WHERE TBL1.id=:id";
                                
            $query = $handler->prepare($sql);
                    
            $query->bindparam(':id', $id);
            $query->bindparam(':name', $name);
            $query->bindparam(':image', $image);

            $query->execute();

            //display success message

            $_SESSION['message'] = "The Image has been uploaded successfully !";
            $_SESSION['msg_type'] = "info";

            echo "<p align='center' class='alert-info' > <font color='green'>To See Changes Click View Result Button.";

            echo "<br/> <p align='center' > <a class='btn btn-success' href='home.php' >View Result</a>";


        } else {

            echo "<p  class='alert-info' align='center' > <font color='orange' size='4pt'>No Records In The Images Table found !";

            // Insert record into images if there is not an image previous saved

            $query = $handler->prepare("INSERT INTO images(images_id, name, image) VALUES ('$id', '$target_file', '$image') ");

            $query->execute();
            
            $_SESSION['message'] = "An Image Has Been Added !";
            $_SESSION['msg_type'] = "success";
            
        }
    }
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
    
    <title>Profile.PHP</title>

</head>
<body>

<div class="container-fluid bg-primary p-2">
    <h3>PROFILE PAGE</h3>
     
	<?php
		if (isset($_SESSION['login_user'])) {
		echo "<h4 align='center' > <font color='white' weight:'bolder' >User logged in: " . $_SESSION['login_user'] .  "<br>";
		}
	?>

</div>


<div class="hero bg-secondary pb-5">

    <br>
    <a href="home.php" class="btn btn-light ml-5" role="button" >GO BACK</a>
    <br>
    <hr class="bg-white">


    <div class="row d-flex justify-content-center col-12">

        <div class="card-columns d-flex flex-column  align-items-center col-5">

            <div class="card bg-primary p-1 text-white  text-center">

                <form method="post" action="profile.php" enctype='multipart/form-data'>

                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                    <input class="btn btn-warning m-2" type="file" name="file" >
                    <input class="btn btn-success font-weight-bolder" type='submit' value='Save Your Image' name='submit'>

                </form>
            </div>

            <div class="card">
                <img class="card-img pt-4 pb-4" src="class.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <?php
                    
                        $result = $handler->query("SELECT * FROM images WHERE images_id=$id ");

                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<center><img class="pb-3" style="width:200px; height:250px;"  src='.$row['image'].'></center>';
                        }
                    ?>
                </div>
            </div>
        </div>


        <div class="card-columns d-flex flex-column  align-items-center col-6">
            <div class="card bg-primary p-2 text-center">
                <h5 class="card-header text-white">this is your saved data:</h5>
            </div>

            <div class="card">
                <img class="card-img" src="class.jpg" alt="Card image">
                <div class="card-img-overlay">
                    <p class="card-text text-primary font-weight-bolder">
                    
                        <?php

                        echo '<table class="table table-sm border table-bordered table-hover font-weight-bolder text-secondary"><tbody>';
                        
                            //fetching data
                            $result = $handler->query("SELECT * FROM users WHERE id=$id ");

                            while($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                                
                                echo '<tr>'.'<td>'.'ID-nr '.'</td>'.'<td>'.$row['id'].'</td>'.'</tr>';

                                echo "<tr>"."<td>"."Username "."</td>"."<td>".$row['username']."</td>"."</tr>";
                                
                                echo "<tr>"."<td>"."Firstname "."</td>"."<td>".$row['firstname']."</td>"."</tr>";

                                echo "<tr>"."<td>"."Lastname "."</td>"."<td>".$row['lastname']."</td>"."</tr>";

                                echo "<tr>"."<td>"."E-mail "."</td>"."<td>".$row['emailaddress']."</td>"."</tr>";

                                echo "<tr>"."<td>"."Active (0/1) "."</td>"."<td>".$row['active']."</td>"."</tr>";
                            }
                        
                        echo '</tbody></table>';

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="row d-flex justify-content-center col-12">
        <div class="card-columns d-flex flex-column  align-items-center col-5">

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
    </div> -->

</div>  



    <!--Bootstrap & Jquery scripts-->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!--Axios script-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <!--Your script-->

    <!-- <script src="script.js">
    </script> -->


</body>
</html>

