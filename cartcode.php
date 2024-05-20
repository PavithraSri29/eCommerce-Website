<?php
session_start();
include('dbconn.php');

    $pid = $_POST['product_id'];
    $qty = $_POST['quantity'];

    if(isset($_SESSION['user_id'])){ 
        $userid = $_SESSION['user_id'];
        $check_cart_query = $conn->query("SELECT * FROM cart WHERE p_id='$pid' AND user_id='$userid'");
        $existing_cart_item = $check_cart_query->fetch_assoc();
        
        if($existing_cart_item) {
            
            $new_quantity = $existing_cart_item['quantity'] + $qty;
            $update_cart_query = $conn->query("UPDATE cart SET quantity='$new_quantity' WHERE p_id='$pid' AND user_id='$userid'");
            if($update_cart_query){
                $cartcount=$conn->query("SELECT COUNT(cart_id) as cartcount FROM cart WHERE user_id='$userid'");
                $cartc=$cartcount->fetch_assoc();
                $data['cartcount']=$cartc['cartcount'];
                $data['status'] = 'success';
                http_response_code(200);
                           
                echo json_encode($data);
            }
            else{
                $data['cartcount']= 0;
                $data['status'] = 'failed';
                http_response_code(400);
                $data['message'] = 'not updated';
            
                echo json_encode($data);
            }
        } else {
            
            $cart = $conn->query("INSERT INTO cart (p_id, quantity, user_id) VALUES ('$pid', '$qty', '$userid')");
            if($cart){
                $cartcount=$conn->query("SELECT COUNT(cart_id) as cartcount FROM cart WHERE user_id='$userid'");
                $cartc=$cartcount->fetch_assoc();
                $data['cartcount']=$cartc['cartcount'];
                $data['status'] = 'success';
                http_response_code(200);
                 

                echo json_encode($data);
            }
            else{
                $data['cartcount']= 0;
                $data['status'] = 'failed';
                http_response_code(400);
                $data['message'] = 'not updated';
            
                echo json_encode($data);
            }
        }
       
    }
     else {
    $data['status'] = 'failed';
    $data['message'] = 'Please login to add items to your cart';
    echo json_encode($data); 
    exit; 
}
?>
