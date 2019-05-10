

<?php

//including the database connection file
include("header.php");

    //getting id of the data from url
    $id = $_GET['id'];
    
    //deleting the row from table
    $sql = ( "DELETE FROM users WHERE id=:id");
    $query = $handler->prepare($sql);
    $query->execute(array(':id' => $id));
    
    //redirecting to the display page (index.php in our case)
    header("Location:index2.php");

?>



