<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database_name = "vaccination_system";

    $con = new mysqli($server_name , $username , $password , $database_name);

    if($con->connect_error) {
        die ("Connection Failed: ".$con->connect_error);
    }
?>



