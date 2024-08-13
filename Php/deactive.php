<?php
    include "config.php";
    $ids = array();
    $ids = $_POST["id"];
    
    
    $deactive = "UPDATE users SET active=0 where UserID= ".$ids." ";
    
    $result = mysqli_query($con,$deactive);
    echo mysqli_error($con);

?>