<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

 <div class="container-fluid px-4">
                        <h3 class="mt-4">Manage Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Product</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                <?php include('message.php'); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Products</h4>
                                        <a href="add-product.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i>&nbsp;Add Product</a>
                                    </div>
                                    <div class="card-body">
                                        <table id="productstable"class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product Id</th>
                                                    <th>Product Name</th>
                                                    <th>Sub Category Name</th>
                                                    <th>Product Image</th>
                                                    <th>MRP</th>
                                                    <th>Discount</th>
                                                    <th>Offer Price</th>
                                                    <th>Stock</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php 
                            $query = $conn->query("SELECT product.*,subcategory.subname FROM `product` join `subcategory` ON product.sub_id=subcategory.sub_id;");
                            if ($query->num_rows > 0) {
                                foreach ($query as $row) { ?>
                                    <tr>
                                        <td><?= $row['p_id']; ?></td>
                                        <td><?= $row['p_name']; ?></td>
                                        <td><?= $row['subname']; ?></td>
                                        <td><img src="../uploads/product/<?= $row['pimg']; ?>" height="60px" width="60px"></td>
                                        <td><?= $row['price']; ?></td>
                                        <td>-<?= $row['discount']; ?>%</td>
                                        <td><?= $row['offerprice']; ?></td>
                                        <td><?= $row['stock']; ?></td>
                                        <form action="code.php" method="POST">
                                        <td> <button type="submit" name="sts-p" value="<?= $row['p_id']; ?>" class="btn <?= ($row['p_sts'] == 1) ? 'btn-success' : 'btn-danger'; ?>">
                                         <?= ($row['p_sts'] == 1) ? 'Active' : 'Inactive'; ?></button></td>
                                        </form>
                                        <td><a href="edit-product.php?id=<?= $row['p_id']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i></a></td>
                                        <form action="code.php" method="POST">
                                        <td><button type="submit" name="del-p" value="<?= $row['p_id']; ?>" class="btn btn-danger"><i class="bi bi-trash3"></i></button></td>
                                       
                                    </form>
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