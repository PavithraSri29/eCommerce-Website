<?php
session_start();
include('dbconn.php');

$product = $_POST['product'];

$prodname=$conn->query("SELECT * FROM product WHERE p_name LIKE '%$product%' AND p_sts=1");
$data['products'] = array();
while ($row = $prodname->fetch_assoc()) {
    $data['products'][] = $row;
}

if (!empty($data['products'])) {
    $data['status'] = 'success';
   
} else {
    $data['status'] = 'failed';
    $data['message'] = 'No product found';

}
echo json_encode($data);
?>