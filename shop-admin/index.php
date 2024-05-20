<?php
include ('config/db.php');
include ('includes/header.php');
$cat = $conn->query("SELECT COUNT(cat_id) FROM category");
$subcat=  $conn->query("SELECT COUNT(sub_id) FROM subcategory");
$prd= $conn->query("SELECT COUNT(p_id) FROM product");
$ord=$conn->query("SELECT COUNT(order_id) FROM orders");
$user=$conn->query("SELECT COUNT(user_id) FROM users");
?>

 <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-light">Total Categories</div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <b><?php echo $cat->fetch_row()[0]; ?></b>
                                        <a class="small text-dark stretched-link" href="view-category.php">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-light">Total Sub Categories</div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                    <b><?php echo $subcat->fetch_row()[0]; ?></b>
                                    <a class="small text-dark stretched-link" href="view-subcategory.php">View Details</a>
                                        <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-light">Total Products</div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                    <b><?php echo $prd->fetch_row()[0]; ?></b>
                                    <a class="small text-dark stretched-link" href="view-product.php">View Details</a>
                                        <!-- <div class="small text-white"><i class="fas fa-angle-right"> <a  href="view-product.php"></a></i></div>  -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-light">Total Customers</div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                    <b><?php echo $user->fetch_row()[0]; ?></b>
                                    <a class="small text-dark stretched-link" href="view-product.php">View Details</a>
                                        <!-- <div class="small text-white"><i class="fas fa-angle-right"> <a  href="view-product.php"></a></i></div>  -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-dark text-light">Total Orders </div>
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                    <b><?php echo $ord->fetch_row()[0]; ?></b>
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <!-- <div class="small text-white"><i class="fas fa-angle-right"></i></div> -->
                                    </div>
                                </div>
                            </div> 
                        </div>

<?php  include ('includes/footer.php');
include ('includes/scripts.php');
?>
