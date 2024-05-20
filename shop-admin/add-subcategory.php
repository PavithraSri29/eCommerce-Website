<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Sub Categories</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item"> Sub Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Sub Categories</h4>
                    <a href="view-subcategory.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    <?php 
                     $categories=$conn->query("SELECT * FROM category ");
                    ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="">Select Category </label>
                                        <select name="catname" class="form-control">
                                            <option value="" class="active">--Select Category-- </option>
                                            <?php
                                                while($res_category=$categories->fetch_assoc()){ ?>
                                                <option value="<?php echo $res_category['cat_id']?>" ><?php echo $res_category['cat_name']?></option>
                                            <?php   
                                             }
                                            ?>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                         <label for="">Sub Category Name</label>
                                         <input type="text" name="scatname" class="form-control">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="">Sub Category Image</label>
                                        <input type="file" name="scatimg" class="form-control">
                                    </div> 
                                    <div class="alert alert-info" role="alert">
                                            Note: Please upload an image less than 2MB and only in JPG or PNG format.
                                        </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary" name="add-scat">Add Sub Category</button>
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
