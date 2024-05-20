<?php
include('shop-admin/config/db.php');
$quantity= $_POST['quantity'];
$prod= $_POST['product_id'];

$userid= $_SESSION['user_id'];
if($userid!=''){
$updateprod=$conn->query("UPDATE cart SET quantity='$quantity' WHERE user_id='$userid' AND p_id='$prod'");
if($updateprod){
    $data['status'] = 'success';
    http_response_code(200);
    $data['message'] = 'Updated Successfully';

    echo json_encode($data);
}else{
    $data['status'] = 'failed';
    http_response_code(400);
    $data['message'] = 'not updated';

    echo json_encode($data);
}
}
else{
    $data['status'] = 'failed';
    http_response_code(400);
    $data['message'] = 'something went wrong';

    echo json_encode($data);
}
?>