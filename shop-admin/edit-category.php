<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Categories</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Categories</h4>
                    <a href="view-category.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])){
                        $catid = $_GET['id'];
                        $query = $conn->query("SELECT * FROM category WHERE cat_id=$catid");

                        if ($query->num_rows > 0) {
                            $row = $query->fetch_assoc();
                            ?>
                            <form action="code.php" method="post">
                                <input type="hidden" name="catid" value="<?=$row['cat_id'];?>">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="">Category Name</label>
                                        <input type="text" name="catname" value="<?= $row['cat_name']; ?>" class="form-control">
                                    </div>


                                    <div class="col-md-12 mb-3">
                                        <label for="">Category Description</label>
                                        <input type="text" name="catdesc" value="<?= $row['cat_des']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary" name="update-cat">Update Category</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <h4>No Record Found</h4>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  include ('includes/footer.php');
include ('includes/scripts.php');
?>
