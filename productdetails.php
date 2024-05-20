<?php include'header.php';

if(isset($_POST['view']) && isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];
  $userid = $_SESSION['user_id'];

  $query =  $conn->query("SELECT * FROM orders WHERE user_id=$userid AND order_id = $order_id");
  
  // $query = $conn->query("SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id WHERE orders.user_id = $userid AND orders.order_id = $order_id");

  if($query && $query->num_rows > 0) {
  $prddetail = [];
  while ($rows = $query->fetch_assoc()) {
      $prddetail[] = $rows;
  }
  $price = 0;
  $discount = 0;
  $offerprice = 0;
  $shipping_charge = 0;
  $subtotal = 0;
  $total_amount = 0;
  $query1 = $conn->query("SELECT * FROM orders INNER JOIN orderdetail ON orders.order_id = orderdetail.order_id INNER JOIN product ON orderdetail.p_id = product.p_id WHERE orders.order_id = $order_id");
  if($query1 && $query1->num_rows > 0) {
  $tableRows = '';
  while($row = $query1->fetch_assoc()) {
  $pimg = $row['pimg'];
  $pname = $row['p_name'];
  $price = $row['price'];
  $p_discount = $row['price'] -$row['offerprice'];
  $quantity = $row['quantity'];
  $total = $row['price'] * $row['quantity'];
  $subtotal += $row['price'] * $row['quantity'];
  $discount += ($row['price'] -$row['offerprice'])* $quantity;
  $offerprice+=$row['offerprice']* $quantity;
  
  $shipping_charge += ($offerprice < 1000) ? 50 : 100;
  $total_amount = $offerprice + $shipping_charge;

 $tableRows .="<tr>
                <td>
                <div class='d-flex align-items-center'>
                    <a href='#!'><img src='uploads/product/$pimg' alt='$pname' style='width:50px;' class='img-4by3-md rounded-3'></a>
                    <div class='ms-3'>
                        <h5 class='mb-0'><a href='#!' class='text-inherit text-decoration-none'>$pname</a></h5>
                    </div>
                </div>
                </td>
                <td>$price</td>
                <td>$p_discount</td>
                <td>$quantity</td>
                <td class='text-end'>&#8377;".number_format($total, 2)."</td>
                </tr>";
 }
 } }

?>



 <div class="app-content-area gradient-custom">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="mb-3">
                <h3 class=" mt-3">Product Details</h3>

              </div>
            </div>
          </div>
          <div>
           

            </div>
            <div class="row mx-md-5 px-3">
              <div class="col-md-12 col-xxl-12 col-12">
                <div class="card mb-lg-5 mb-3">
                 
                  <div class="card-body">
                    <div class="table-responsive table-card">
                      <table class="table text-nowrap mb-0 table-centered">
                        <thead class="table-light">
                          
                          <tr>
                          
                            <!-- <th scope="col">S.no</th> -->
                            <th scope="col">Products</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Qty</th>
                            <th scope="col" class="text-end">Total</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        <?php echo $tableRows; ?>
                         
                        </tbody>
                        <tfoot>
                          <tr><td></td><td></td><td></td><td></td>
                          <td>
                          <ul class="list-unstyled">
            <li class="text-muted ms-3 text-end"><span class="text-black me-4">SubTotal</span>&#8377;<?php echo number_format($subtotal, 2);?></li>
            <li class="text-danger ms-3 mt-2 text-end"><span class="text-black me-3">Discount</span>&minus; &#8377;<?php echo  number_format($discount, 2);?></li>
            <li class="text-muted ms-3 mt-2 text-end"><span class="text-black me-3"> Offer Price</span>&#8377;<?php echo  number_format($offerprice, 2);?></li>
            <li class="text-muted ms-3 mt-2 text-end"><span class="text-black me-4">Shipping Prices</span>&plus; &#8377;<?php echo  number_format($shipping_charge, 2);?></li>
            <li class="text-black ms-3 mt-2 text-end"><span class="text-black me-4"> Total Amount</span>&#8377;<?php echo  number_format($total_amount, 2);?></span></li> <!-- Adjust font size based on screen size -->
        </ul>
                          </td>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                   
                    <!-- <div class="row justify-content-md-end align-items-center" style="padding-right: 50px;"> 
    <div class="col-md-12 mt-5 text-md-end pe-md-5"> 
        <ul class="list-unstyled">
            <li class="text-muted ms-3"><span class="text-black me-3">SubTotal</span>&#8377;<?php echo number_format($subtotal, 2);?></li>
            <li class="text-danger ms-3 mt-2"><span class="text-black me-2">Discount</span>&minus; &#8377;<?php echo number_format($discount, 2);?></li>
            <li class="text-muted ms-3 mt-2"><span class="text-black me-2"> Offer Price</span>&#8377;<?php echo number_format($offerprice, 2);?></li>
            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Shipping Prices</span>&plus; &#8377;<?php echo number_format($shipping_charge, 2);?></li>
            <li class="text-black ms-3 mt-2"><span class="text-black me-3"> Total Amount</span>&#8377;<?php echo number_format($total_amount, 2);?></span></li> 
        </ul>
    </div>
  
 </div> -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
 }else {
  // $price = 0;
  // $discount = 0;
  // $offerprice = 0;
  // $shipping_charge = 0;
  // $subtotal = 0;
  // $total_amount = 0;
  // $tableRows ="<tr>
  //               no data found.
  //               </tr>";
  ?>
   <div class="text-center gradient-custom" style="padding-top:180px; padding-bottom:180px;"><h3>No Data Found</h3></div> 
  <?php
 } 
//  }
?>

<?php include'footer.php';?>