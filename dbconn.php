<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shopie";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn -> connect_error) {
        die("connection failed: ".$conn -> connect_error);
    }
    // echo "<script> alert('connected successfully');</script>";
?>