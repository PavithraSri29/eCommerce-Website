<?php
session_start();
include 'dbconn.php';

// if(isset($_SESSION['user_id'])){
//     header('Location:login.php');
//     exit();
// }

if(isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $user_password = $conn->real_escape_string(md5($_POST['password']));

    $sql = $conn->query("SELECT * FROM users WHERE email ='$email' AND password ='$user_password'");

    if($sql->num_rows == 1) {
        $row = $sql->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        header('Location:index.php');
        exit();
    } else {
        echo '<script> alert ("Invalid email or password.")
        window.location.href="login.php";</script>';
    }
}
$conn->close();

?>