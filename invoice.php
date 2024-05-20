<?php

require_once __DIR__ . '/vendor/autoload.php';
$invoiceFileName = '';
// $username = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invoice']) && isset($_POST['order_id'] )) {
  $mpdf = new \Mpdf\Mpdf();
  ob_start(); // Start output buffering

  // Begin embedded HTML
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Invoice</title>
    <style>
      body, html {
        font-family: Arial, Helvetica, sans-serif;
        height: 100%;
      }
      .invoice-container {
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      }
      .invoice-header h2 {
        color: #007bff;
      }
      .invoice-details ul {
        list-style: none;
        padding-left: 0;
      }
      .invoice-details ul li {
        margin-bottom: 5px;
      }
      .invoice-table th, .invoice-table td {
        vertical-align: middle;
      }
      .userdetails{
        padding-bottom:15px;
      }
      .userdetailspace{
        margin-bottom:5px;
      }
      h1{
        font-size:24px;
      }
      /* .details {
        margin-bottom:55px;
      }
      #tablehead{
        padding-bottom:10px;
      } */
      .invoice-table {
      width: 100%;
    }
    .invoice-table th,
    .invoice-table tbody td {
      padding: 10px;
    }
    .invoice-table tbody tr.details {
      background-color: #f8f9fa; /* Light gray background for rows */
    }
    .invoice-table tfoot td.amount {
      font-weight: bold;
      padding-top:3px;
      padding-right:5px;
    }
    .invoice-table tfoot tr:last-child {
      background-color: #f8f9fa; /* Light gray background for last row */
    }
    #footer {
      margin-top:10px;
    }
   
    ul li{
      
    }
    </style>
  </head>
  <body>
  <?php
  date_default_timezone_set('Asia/Kolkata');

  session_start();
  include 'dbconn.php';
  require_once __DIR__ . '/vendor/autoload.php';
  $price = 0;
  $discount = 0;
  $offerprice = 0;
  $shipping_charge = 0;
  $subtotal = 0;
  $total_amount = 0;
  $prddetail = [];
  $tableRows = '';

  if(isset($_POST['invoice']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $userid = $_SESSION['user_id'];

    $query = $conn->query("SELECT * FROM orders, users WHERE users.user_id=$userid AND orders.order_id = $order_id");

    if($query && $query->num_rows > 0) {
      $row = $query->fetch_assoc();
        $prddetail[] = $row; 
        $invoiceFileName = $row['invoiceno'];
        $username = $row['name'];
        $htmlcontent = '<div id="invoice-content" class="card px-md-5 pb-md-5 gradient-custom">';
        $htmlcontent .= '<div class="text-end" style="margin-bottom: 10px">';
        $htmlcontent .= '<div>'.date('d-m-Y').'</div>';
        $htmlcontent .= '<div>'.date('H:i:s').'</div>';
        $htmlcontent .= '</div>';

       
        $htmlcontent .= '<div class="card-body">';
        $htmlcontent .= '<div class="container mb-3">';
        $htmlcontent .= '<h1 class="text-center">Invoice Bill</h1>';
        $htmlcontent .= '</div>';

        // $htmlcontent .= '<div  style="display: flex; justify-content:space-between;">';
        $htmlcontent .= '<div  style="text-align: right;">';
     

        $htmlcontent .= '<ul class="list-unstyled" style="list-style-type: none; padding-left: 0;  align-item: right;">';
        $htmlcontent .= '<img src="img\shopielogo.png" alt="logo" class="text-end" style=" width:130px; float:right;  margin-right: 90px;">';
        $htmlcontent .= '<li class="text-start">Invoice Number: <span>'. $row['invoiceno'].'</span></li>';
        $htmlcontent .= '<li class="text-start">Order Date: <span>'. $row['ord_date'].'</span></li>';
        $htmlcontent .= '<li class="text-start">Order ID: <span>'. $row['order_id'].'</span></li>';     
        $htmlcontent .= '</ul>';
        // $htmlcontent .= '</div>';
        // $htmlcontent .= '<div  style="flex: 1;" class="watermark">';
        $htmlcontent .= '</div>';
        // $htmlcontent .= '</div>';
        $htmlcontent .= '<hr>';
        $htmlcontent .= '<div class="row userdetails">';
        $htmlcontent .= '<div class="col-md-6">';
        $htmlcontent .= '<div class="userdetailspace">UserName: <span>'. $row['name'].'</span></div>';
        $htmlcontent .= '<div class="userdetailspace">Email: <span>'. $row['email'].'</span></div>';
        $htmlcontent .= '<div class="userdetailspace">Phone Number: <span>'. $row['phoneno'].'</span></div>';
        $htmlcontent .= '</div>';
        $htmlcontent .= '<div class="col-md-6">';
        $htmlcontent .= '<div class="userdetailspace">Shipping Address: <span>'. $row['shipping_address'].'</span></div>';
        $htmlcontent .= '<div class="userdetailspace">Billing Address: <span>'. $row['billing_address'].'</span></div>';
        $htmlcontent .= '</div>';
        $htmlcontent .= '</div>';
        $htmlcontent .= '</div>';

        $query1 = $conn->query("SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id INNER JOIN product ON orderdetail.p_id = product.p_id WHERE orders.order_id = $order_id");

        if($query1 && $query1->num_rows > 0) {
          while($row = $query1->fetch_assoc()) {
            $pname = $row['p_name'];
            $price = $row['price'];
            $p_discount = $row['price'] - $row['offerprice'];
            $quantity = $row['quantity'];
            $total = $row['price'] * $row['quantity'];
            $subtotal += $row['price'] * $row['quantity'];
            $discount += ($row['price'] - $row['offerprice']) * $quantity;
            $offerprice += $row['offerprice'] * $quantity;

            $shipping_charge += ($offerprice < 1000) ? 50 : 100;
            $total_amount = $offerprice + $shipping_charge;

            $tableRows .= "<tr class='details'>
                            <td>$pname</td>
                            <td>$price</td>
                            <td>$p_discount</td>
                            <td>$quantity</td>
                            <td class='text-end'>&#8377;".number_format($total, 2)."</td>
                          </tr>";
          }
        }

        $htmlcontent .= '<div class="row my-2 mx-1 justify-content-center mt-5">';
        $htmlcontent .= '<table id="myTable" class="table table-striped table-borderless text-nowrap mb-0 table-centered invoice-table">';
        $htmlcontent .= '<thead class="bg-primary text-white">';
        $htmlcontent .= '<tr id="tablehead">';
        $htmlcontent .= '<th scope="col">Description</th>';
        $htmlcontent .= '<th scope="col">Price</th>';
        $htmlcontent .= '<th scope="col">Discount</th>';
        $htmlcontent .= '<th scope="col">Qty</th>';
        $htmlcontent .= '<th scope="col text-end" style="float:right;">Amount</th>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '</thead>';
        $htmlcontent .= '<tbody>';
        $htmlcontent .= $tableRows;
        $htmlcontent .= '</tbody>';
        $htmlcontent .= '<tfoot id="footer">';
        $htmlcontent .= '<tr >';
        $htmlcontent .= '<td colspan="4" class="text-end amount" style="padding-top:20px;">SubTotal</td>';
        $htmlcontent .= '<td style="padding-top:20px;" class="text-end">&#8377; ' . number_format($subtotal, 2).'</td>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '<tr>';
        $htmlcontent .= '<td colspan="4" class="text-end amount">Discount</td>';
        $htmlcontent .= '<td class="text-end">&#8377; '. number_format($discount, 2).'</td>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '<tr>';
        $htmlcontent .= '<td colspan="4" class="text-end amount">Offer Price</td>';
        $htmlcontent .= '<td  class="text-end">&#8377;'. number_format($offerprice, 2).'</td>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '<tr>';
        $htmlcontent .= '<td colspan="4" class="text-end amount">Shipping Price</td>';
        $htmlcontent .= '<td class="text-end">&#8377;'. number_format($shipping_charge, 2).'</td>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '<tr>';
        $htmlcontent .= '<td colspan="4" class="text-end amount">Total Amount</td>';
        $htmlcontent .= '<td class="text-end">&#8377;'. number_format($total_amount, 2).'</td>';
        $htmlcontent .= '</tr>';
        $htmlcontent .= '</tfoot>';
        $htmlcontent .= '</table>';
        $htmlcontent .= '</div>';

        $htmlcontent .= '</div>';
        $htmlcontent .= '</div>';

        echo $htmlcontent;
      }
    }
  
  ?>
  </body>
  </html>
  <?php
  // End embedded HTML

  $invoice = ob_get_clean();
   // Get the output buffer contents and clean it

  $mpdf->WriteHTML($invoice);
  // $mpdf->Output($username.'-'.$invoiceFileName.'.pdf', 'D');
//  
if (!empty($invoiceFileName)) {
  $mpdf->Output($username.'-'.$invoiceFileName.'.pdf', 'D');
    exit;
}
}
?>
