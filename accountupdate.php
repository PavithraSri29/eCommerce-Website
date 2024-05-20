<?php
session_start();
include 'dbconn.php';
if(isset($_POST['profile'])) {
    $userid = $_SESSION['user_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['flexRadioDefault'];

    // Update user profile
    $updateUserQuery = "UPDATE users SET name='$name', dob='$dob', gender='$gender' WHERE user_id=$userid";
    $result = $conn->query($updateUserQuery);

    if($result) {
        echo '<script>alert("Profile updated successfully!"); window.location.href = "account.php";</script>';
        exit;
    } else {
        echo '<script>alert("Failed to update profile. Please try again later."); window.location.href = "account.php";</script>';
        exit;
    }
}
if(isset($_POST['address'])) {
    $userid = $_SESSION['user_id'];
    $door = $_POST['doorno'];
    $street = $_POST['street'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $landmark = $_POST['landmark'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $state = $_POST['state'];
    $country = $_POST['country'];
$address=$conn->query("INSERT INTO useraddress(user_id,doorno,streetname,area,city,landmark,district,pincode,state,country) VALUES('$userid','$door','$street','$area','$city','$landmark','$district','$pincode','$state','$country')");
if($address){
    echo '<script>alert("New address saved."); window.location.href = "account.php";</script>';
        exit;
}
else{
    echo '<script>alert("Failed to update profile. Please try again later."); window.location.href = "account.php";</script>';
        exit;
}
}
?>
