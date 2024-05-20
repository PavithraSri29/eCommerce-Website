<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

 <div class="container-fluid px-4">
                        <h3 class="mt-4">Manage Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Orders</li>
                        </ol>
                        <div class="row ">
                            <div class="col-md-12">
                            <?php include('message.php'); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Orders</h4>
                                      
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>OrderId</th>
                                                    <th>Invoice No</th>
                                                    <th>User Name</th>
                                                    <th>Order Date</th>
                                                    <th>Shipping Address </th>
                                                    <th>Billing Address</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php 
                             $query = $conn->query("SELECT orders.*,users.name FROM `orders` join `users` ON orders.user_id=users.user_id;");

                            if ($query) {
                                foreach ($query as $row) { ?>
                                    <tr>
                                        <td><?= $row['order_id']; ?></td>
                                        <td><?= $row['invoiceno']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['ord_date']; ?></td>
                                        <td><?= $row['shipping_address']; ?></td>
                                        <td><?= $row['billing_address']; ?></td>
                                        <td><a href="view-orderdetail.php?id=<?php echo $row['order_id']?>" class="btn btn-primary">View</a></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        </div>

<?php  include ('includes/footer.php');
include ('includes/scripts.php');
?>