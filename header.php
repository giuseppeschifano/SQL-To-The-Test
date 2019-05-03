
<?php

try {
    $handler=new PDO ('mysql:host=localhost;dbname=sql_ex;charset=utf8', 'phpmyadmin', 'Kblsrfrs.99');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e) {
    echo $e->getMessage();
    die();
} 

?>

