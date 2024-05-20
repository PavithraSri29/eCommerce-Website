<?php 
session_start();
    $conn = new mysqli('localhost', 'root', '', 'shopie');
    if ($conn->connect_error) {
        die('Connection Failed. Error: ' . $conn->connect_error);
    } 
    
?>