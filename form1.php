<?php
    include 'dbconn.php';

    if(isset($_POST['submit'])) {
        
        $name = $_POST['name'];
        $email =$_POST['email'];
        $phoneno = $_POST['phoneNumber'];
        $user_password = md5($_POST['password']);

        $sql = $conn->query("SELECT * FROM users WHERE email = '$email'");
        if($sql->num_rows > 0) {
            echo '<script> alert("User with this email address is already registered.")</script>';
        } else {
            $sqli = $conn->query("INSERT INTO users (name,email,phoneno,password) VALUES ('$name','$email','$phoneno','$user_password')");
            if($sqli) {
                // echo'<h1> THANK YOU FOR REGISTERING!</h1>'."<br>";
                // echo '<p>Your registration was successful. WELCOME TO ELECTRONIC STORE</P>'."<br>";
                header("Location:login.php");
            } else {
                echo "Error:".$sql."<br>".$conn->error;
            }
        }
    }

    $conn->close();
?>