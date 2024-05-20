<?php
session_start();
include('dbconn.php');

$is_in_wishlist = false;
if(isset($_SESSION['user_id'])) {
    $pid = $_POST['product_id'];
    $userid = $_SESSION['user_id'];
    
    $check_wish = $conn->query("SELECT * FROM wishlist WHERE p_id='$pid' AND user_id='$userid'");
    $existing_wish = $check_wish->fetch_assoc();
    
    if($existing_wish) {
        
        $delete_wish = $conn->query("DELETE FROM wishlist WHERE p_id='$pid' AND user_id='$userid'");
        if($delete_wish) {
           
            $is_in_wishlist = false;
            $wishcount = $conn->query("SELECT COUNT(wishlist_id) as wishcount FROM wishlist WHERE user_id='$userid'");
            $wishc = $wishcount->fetch_assoc();
            $data['wishcount'] = $wishc['wishcount'];
            $data['status'] = 'success';
            http_response_code(200);
        } else {
            $data['status'] = 'failed';
            $data['message'] = 'Failed to remove product from wishlist';
            http_response_code(400);
        }
    } else {

        $add_wish = $conn->query("INSERT INTO wishlist (p_id, user_id) VALUES ('$pid', '$userid')");
        if($add_wish) {
 
            $is_in_wishlist = true;
            $wishcount = $conn->query("SELECT COUNT(wishlist_id) as wishcount FROM wishlist WHERE user_id='$userid'");
            $wishc = $wishcount->fetch_assoc();
            $data['wishcount'] = $wishc['wishcount'];
            $data['status'] = 'success';
            http_response_code(200);
        } else {
        
            $data['status'] = 'failed';
            $data['message'] = 'Failed to add product to wishlist';
            http_response_code(400);
        }
    }
} else {
  
    $data['status'] = 'failed';
    $data['message'] = 'Please login to add items to your wishlist';
}
$data['is_in_wishlist'] = $is_in_wishlist; 
echo json_encode($data);
?>
