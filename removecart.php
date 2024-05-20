<?php
session_start();
include('dbconn.php');

    $pid = $_POST['product_id'];
    $userid = $_SESSION['user_id'];
?>
<?php

    $query = $conn->query("DELETE FROM cart WHERE p_id='$pid' AND user_id='$userid'");

        if ($query) {
            $data['status'] = 'success';
            http_response_code(200);
            $data['message'] = 'deleted';           
            echo json_encode($data);
        } else {
            $data['status'] = 'failed';
            http_response_code(400);
            $data['message'] = 'not updated';
        
            echo json_encode($data);
        }

?>