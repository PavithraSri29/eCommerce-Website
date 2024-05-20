<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

 <div class="container-fluid px-4">
                        <h3 class="mt-4">Manage Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Category</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12">
                                <?php include('message.php'); ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Categories</h4>
                                        <a href="add-category.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i>&nbsp;Add Category</a>
                                    </div>
                                    <div class="card-body">
                                        <table id="cattable"class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Category Id</th>
                                                    <th>Category Name</th>
                                                    <th>Category Description</th>
                                                    <th>Status</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                            <?php 
                            $query = $conn->query("SELECT * FROM category");
                            if ($query->num_rows > 0) {
                                foreach ($query as $row) { ?>
                                    <tr>
                                        <td><?= $row['cat_id']; ?></td>
                                        <td><?= $row['cat_name']; ?></td>
                                        <td><?= $row['cat_des']; ?></td>
                                        <form action ="code.php" method="POST">
                                        <td> <button type="submit" name="sts-cat" value="<?= $row['cat_id']; ?>" class="btn <?= ($row['cat_sts'] == 1) ? 'btn-success' : 'btn-danger'; ?>">
                                                    <?= ($row['cat_sts'] == 1) ? 'Active' : 'Inactive'; ?>
                                                </button></td>
                                        </form>
                                        <td><a href="edit-category.php?id=<?= $row['cat_id']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i>&nbsp;Edit</a></td>
                                        <form action="code.php" method="POST">
                                        <td><button type="submit" name="del-cat" value="<?= $row['cat_id']; ?>" class="btn btn-danger"><i class="bi bi-trash3"></i>&nbsp;Delete</button></td>
                                        
                                    </form>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="6">No Record Found</td>
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