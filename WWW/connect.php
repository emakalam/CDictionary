<?php
session_start();
    $server = "localhost";
    $user = "root";
    $pass = "makz123#";
    $db   = "cdict";

    $conn = new mysqli($server, $user, $pass, $db);
    if ( !$conn){
        echo mysqli_connect_error(); //this itself will give error on client side parsing
    die();
}
?>
