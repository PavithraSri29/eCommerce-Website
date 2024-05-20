<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

 <div class="container-fluid px-4">
                        <h3 class="mt-4">Manage Sub Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Sub Category</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                <?php include('message.php'); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Sub Categories</h4>
                                        <a href="add-subcategory.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i>&nbsp; Add Sub Category</a>
                                    </div>
                                    <div class="card-body">
                                        <table id="subcategoriesTable" class="table table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>Sub Category Id</th>
                                                    <th>Sub Category Name</th>
                                                    <th>Category Name</th>
                                                    <th>Sub Category Image</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php 
                            $query = $conn->query("SELECT subcategory.*,category.cat_name FROM `subcategory` join `category` ON category.cat_id=subcategory.cat_id;");
                            if ($query->num_rows > 0) {
                                foreach ($query as $row) { ?>
                                    <tr>
                                        <td><?= $row['sub_id']; ?></td>
                                        <td><?= $row['subname']; ?></td>
                                        <td><?= $row['cat_name']; ?></td>
                                        <td><img src="../uploads/sub/<?= $row['subimg']; ?>" height="60px" width="60px"></td>
                                        <form action="code.php" method="POST">
                                        <td> <button type="submit" name="sts-scat" value="<?= $row['sub_id']; ?>" class="btn <?= ($row['sub_sts'] == 1) ? 'btn-success' : 'btn-danger'; ?>">
                                                    <?= ($row['sub_sts'] == 1) ? 'Active' : 'Inactive'; ?>
                                                </button></td>
                                        </form>
                                        <td><a href="edit-subcategory.php?id=<?= $row['sub_id']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i>&nbsp;Edit</a></td>
                                        <form action="code.php" method="POST">
                                           <td><button type="submit" name="del-scat" value="<?= $row['sub_id']; ?>" class="btn btn-danger"><i class="bi bi-trash3"></i>&nbsp;Delete</button>
                                           </td>
                                          
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
