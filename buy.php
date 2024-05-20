<?php
session_start();
include('dbconn.php');

    $pid = $_POST['productid'];
     $qty = $_POST['quantity'];

     if(isset($_SESSION['user_id'])){ 
        $userid = $_SESSION['user_id'];
        $check_cart_query = $conn->query("SELECT * FROM cart WHERE p_id='$pid' AND user_id='$userid'");
        $existing_cart_item = $check_cart_query->fetch_assoc();
        
        if($existing_cart_item) {
            
            $new_quantity = $existing_cart_item['quantity'] + $qty;
            $update_cart_query = $conn->query("UPDATE cart SET quantity='$new_quantity' WHERE p_id='$pid' AND user_id='$userid'");
            if($update_cart_query){
                $data['status'] = 'success';
                http_response_code(200);
                $data['message'] = 'Updated Successfully';
                echo json_encode($data);
            }
            else{
                $data['status'] = 'failed';
             http_response_code(400);
                $data['message'] = 'something went wrong';
                echo json_encode($data);
            }
        } else {
            
            $cart = $conn->query("INSERT INTO cart (p_id, quantity, user_id) VALUES ('$pid', '$qty', '$userid')");
            if($cart){
                $data['status'] = 'success';
                http_response_code(200);
                $data['message'] = 'Updated Successfully';
                echo json_encode($data);
            }
            else {
                $data['status'] = 'failed';
                http_response_code(400);
                $data['message'] = 'something went wrong';
                echo json_encode($data);
            }
        }
    } else {
        $data['status'] = 'failed';
        $data['message'] = 'Please login to buy items';
        echo json_encode($data); 
        exit; 
    }

?>