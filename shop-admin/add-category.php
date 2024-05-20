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
                    <h4>Add Categories</h4>
                    <a href="view-category.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                <form action="code.php" method="post">
                                <div class="row">
                                    <!-- <div class="col-md-12 mb-3">
                                        <label for="">Category id</label>
                                        <input type="text" name="catid" class="form-control">
                                    </div> -->
                                    <div class="col-md-12 mb-3">
                                         <label for="">Category Name</label>
                                         <input type="text" name="catname" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">Category Description</label>
                                        <input type="text" name="catdesc" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary" name="add-cat">Add Category</button>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php  include ('includes/footer.php');
include ('includes/scripts.php');
?>
