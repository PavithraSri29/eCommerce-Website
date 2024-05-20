<?php

session_start();
include 'dbconn.php';

    $userid = $_SESSION['user_id'];
    $paymethod = $_POST['paymentmethod'];
    $orddate = date("Y-m-d H:i:s");
    $ship = $_POST['shippingaddress'];
    $bill = $_POST['billingaddress'];
    $cart = $conn->query("SELECT p_id FROM cart WHERE user_id=$userid");
    if($cart){
    if($ship == $bill) {
        $shipaddress = $conn->query("SELECT * FROM useraddress WHERE address_id='$ship'");
        $shipping = $shipaddress->fetch_assoc();
        $shipping_address = $shipping['doorno'] . ',' . $shipping['streetname'] . ',' . $shipping['area'] . ',' . $shipping['city'] . ',' . $shipping['landmark'] . ',' . $shipping['district'] . ',' . $shipping['pincode'] . ',' . $shipping['state'] . ',' . $shipping['country'];
        $billing_address = $shipping_address;
    } else {
        $shipaddress = $conn->query("SELECT * FROM useraddress WHERE address_id='$ship'");
        $billaddress = $conn->query("SELECT * FROM useraddress WHERE address_id='$bill'");

        $shipping = $shipaddress->fetch_assoc();
        $billing = $billaddress->fetch_assoc();

        $shipping_address = $shipping['doorno'] . ',' . $shipping['streetname'] . ',' . $shipping['area'] . ',' . $shipping['city'] . ',' . $shipping['landmark'] . ',' . $shipping['district'] . ',' . $shipping['pincode'] . ',' . $shipping['state'] . ',' . $shipping['country'];
        $billing_address = $billing['doorno'] . ',' . $billing['streetname'] . ',' . $billing['area'] . ',' . $billing['city'] . ',' . $billing['landmark'] . ',' . $billing['district'] . ',' . $billing['pincode'] . ',' . $billing['state'] . ',' . $billing['country'];
    }
    
    $price = 0;
    $discount = 0;
    $offerprice = 0;
    $shipping_charge = 0;
    $total_amount = 0;
    $invoice = rand();

    $orders = $conn->query("INSERT INTO orders (user_id, paymentmethod, ord_date, total, shipping_charge, shipping_address, billing_address, invoiceno,orderstatus_id) VALUES ('$userid', '$paymethod', '$orddate', '$offerprice', '$shipping_charge', '$shipping_address', '$billing_address', '$invoice',1)");


    if ($orders) {
       
        $order_id = $conn->insert_id;
        $orderconfirm=$conn->query("INSERT INTO orderconfirmation(order_id,orderstatus_id) VALUES ('$order_id',1)");
        $query = $conn->query("SELECT p_id,quantity FROM cart WHERE user_id=$userid");
        while ($row = $query->fetch_assoc()) {
            $p_id = $row['p_id'];
            $quantity = $row['quantity'];
            $product_query = $conn->query("SELECT * FROM product WHERE p_id=$p_id");
            $product = $product_query->fetch_assoc();
            $price += $product['price'] * $quantity;
            $discount += ($product['price'] - $product['offerprice']) * $quantity;
            $offerprice += $product['offerprice'] * $quantity;

            $price_pro= $product['price'];
            $offerprice_pro= $product['offerprice'];
            $discount_pro= ($product['price'] - $product['offerprice']);

            $orderdet = $conn->query("INSERT INTO orderdetail (order_id, p_id, price, offerprice, quantity, discount) VALUES ('$order_id', '$p_id', '$price_pro', '$offerprice_pro', '$quantity', '$discount_pro')");
            
        }
    
        $shipping_charge = ($offerprice < 1000) ? 50 : 100;
        $total = $offerprice; 
        $updateords=$conn->query("UPDATE `orders` SET `total`='$total',`shipping_charge`='$shipping_charge' WHERE order_id='$order_id'");
        
        if ($updateords) {
            $deletecart = $conn->query("DELETE FROM `cart` WHERE user_id=$userid");
            if($deletecart){
            $data['orderid']=$order_id;
            $data['status'] = 'success';
            http_response_code(200); 
            $data['message'] = 'Order Placed';       
            echo json_encode($data);
            }
        } else {
            
            $data['status'] = 'failed';
            http_response_code(400);
            $data['message'] = 'Order not placed';
            echo json_encode($data);
        }
    } else {
      
        $data['status'] = 'failed';
            http_response_code(400);
            $data['message'] = 'error in order';
            echo json_encode($data);
    }
}

?>

