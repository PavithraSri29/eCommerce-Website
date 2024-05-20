<?php
include('config/db.php');
include('log.php');

if(isset($_POST['updateordersts'])) {
    $orderid = $_POST['orderid'];
    $orderstatus = $_POST['orderstatus'];
    $comment = $_POST['comment'];

    $updateOrderStatusQuery = $conn->query("UPDATE orders SET orderstatus_id='$orderstatus' WHERE order_id='$orderid'");
    if(!$updateOrderStatusQuery) {
        $_SESSION['message'] = "Failed to update order status.";
        header("location:ordersts.php");
        exit(0);
    }

    $insertOrderConfirmationQuery = $conn->query("INSERT INTO orderconfirmation (order_id, orderstatus_id, comments) VALUES ('$orderid','$orderstatus','$comment')");
    if(!$insertOrderConfirmationQuery) {
        $_SESSION['message'] = "Failed to insert order confirmation.";
        header("location:ordersts.php");
        exit(0);
    }

    $_SESSION['message'] = "Order status updated successfully.";
    header("location:view-orders.php");
    exit(0);
}

?>