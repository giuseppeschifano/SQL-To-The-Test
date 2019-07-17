

<?php
//including the database connection file
include("header.php");
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

    //getting id of the data from url
    $id = $_GET['id'];
    

    //deleting the row from table
    $sql = ( "DELETE FROM users WHERE id=:id");
    $query = $handler->prepare($sql);
    $query->execute(array(':id' => $id));
    

    $_SESSION['message'] = "Record has been deleted !";
    $_SESSION['msg_type'] = "danger";


    //redirecting to the display page (index.php in our case)
    header("Location:index2.php");

?>



