<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');

if (isset($_GET['id'])) {
    $orderid = $_GET['id'];

   
    $query = $conn->query("SELECT orders.*, users.name 
                            FROM `orders` 
                            JOIN `users` ON orders.user_id = users.user_id AND orders.order_id = $orderid");
   

    if ($query) {
        $row = $query->fetch_assoc();

        $totalPrice = 0;
        $totalDiscount = 0;
        $totalOfferPrice = 0;

        $order_detail_query = $conn->query("SELECT * FROM orderdetail WHERE order_id = $orderid");
      
        if ($order_detail_query) {
            
            while ($detail_row = $order_detail_query->fetch_assoc()) {
                
                $totalPrice += $detail_row['price'] * $detail_row['quantity'];
                
                $totalDiscount += $detail_row['discount'] * $detail_row['quantity'];

                $totalOfferPrice += $detail_row['offerprice'] * $detail_row['quantity'];
            }
        }

  
        $subtotal = $totalPrice - $totalDiscount;
?>
<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Orders</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Orders</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                    <a href="view-orders.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    
                    <p><strong>Order ID:</strong> <?= $row['order_id']; ?></p>
                    <p><strong>Order Date:</strong> <?= $row['ord_date']; ?></p>
                    <p><strong>Invoice No:</strong> <?= $row['invoiceno']; ?></p>
                    <p><strong>Username: </strong><?= $row['name']; ?></p>
                    <p><strong>Shipping Address:</strong> <?= $row['shipping_address']; ?></p>
                    <p><strong>Billing Address:</strong> <?= $row['billing_address']; ?></p>
                    <p><strong>Payment Method:</strong> <?= $row['paymentmethod']; ?></p>

                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                          
                            $order_detail = $conn->query("SELECT * FROM orderdetail WHERE order_id = '$orderid'");
                        
                            if ( $order_detail) {
                                while ($detail_row =  $order_detail->fetch_assoc()) {
                                    $pid = $detail_row['p_id'];
                                    $pname = $conn->query("SELECT p_name FROM product WHERE p_id='$pid'");
                                    $prdct = $pname->fetch_assoc();
                            ?>
                            <tr>
                                <td><?= $prdct['p_name']; ?></td>
                                <td><?= $detail_row['quantity']; ?></td>
                                <td class="text-end"><?= number_format(($detail_row['quantity']) * ($detail_row['price']),2); ?></td>
                            </tr>
                            <?php
                                }
                            } else {
                            ?>
                            <tr>
                                <td colspan="3">No product details found for this order.</td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr><td></td><td></td>
                            <td>
                            <p class="text-end">Price: &#8377;<?= number_format($totalPrice, 2); ?></p>
                            <p class="text-end text-danger">Discount: &minus; &#8377;<?= number_format($totalDiscount, 2); ?></p>
                            <hr />
                            <p class="text-end">Offer Price: &#8377;<?= number_format(($totalPrice - $totalDiscount), 2); ?></p>
                            <p class="text-end">Shipping Charge: &plus; &#8377;<?= number_format($row['shipping_charge'], 2); ?></p>
                            <hr />
                            <p class="text-end fw-bold">Total Amount: &#8377;<?= number_format(($row['total'] + $row['shipping_charge']), 2); ?></p>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Order Status</h4>
                    <form action="ordersts.php" method="post">
    <input type="hidden" name="orderid" value="<?= $row['order_id']; ?>">
    <?php 
        $orderconfsts = $conn->query("SELECT orderstatus.*  FROM orders JOIN orderstatus ON orders.orderstatus_id=orderstatus.ordersts_id WHERE orders.order_id='".$row['order_id']."'");
        $orderconfst = $orderconfsts->fetch_assoc();
        $orderconfirm = $conn->query("SELECT * FROM orderconfirmation");
        $orderstatus = $conn->query("SELECT orderstatus.* FROM orderstatus WHERE ordersts_id > '".$orderconfst['ordersts_id']."' " );
        $ordercon=$orderconfirm->fetch_assoc();
    ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="">Current Order Status</label>
            <input type="text" class="form-control" value="<?= $orderconfst['name']; ?>" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Change Order Status</label>
            <select name="orderstatus" class="form-control">
            <option value="" class="active">--Select Order Status-- </option>
                <?php while($ordersts = $orderstatus->fetch_assoc()): ?>
                        <option value="<?= $ordersts['ordersts_id']; ?>"><?= $ordersts['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-12 mb-4">
            <label for="">Comments</label>
            <textarea name="comment" class="form-control h-100" rows="3"><?= $ordercon['comments']; ?></textarea>
        </div>
        <div class="col-md-12 mb-2 mt-4 text-center">
             <button type="submit" class="btn btn-primary" name="updateordersts">Update Order Status</button>
        </div>
     
        </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php
    } else {
        echo "<p>No order found with ID: $orderid</p>";
    }
}
?>

<?php include ('includes/footer.php'); ?>
<?php include ('includes/scripts.php'); ?>
