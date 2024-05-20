<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Sub Categories</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Sub Category</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Sub Categories</h4>
                    <a href="view-subcategory.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])){
                        $scatid = $_GET['id'];
                        $query = $conn->query("SELECT * FROM subcategory WHERE sub_id=$scatid");
                        $categories=$conn->query("SELECT * FROM category ");

                        if ($query->num_rows > 0) {
                            $row = $query->fetch_assoc();
                            ?>
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="scatid" value="<?=$row['sub_id'];?>">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                            <label for="">Select Category </label>
                                        <select name="catname" class="form-control">
                                            <option value="" class="active">Select Category </option>
                                            <?php
                                                while($res_category=$categories->fetch_assoc()){ ?>
                                                <option value="<?php echo $res_category['cat_id']?>" <?php echo $res_category['cat_id']==$row['cat_id'] ?'selected':''?> ><?php echo $res_category['cat_name']?></option>
                                            <?php   
                                             }
                                            ?>
                                        
                                        </select>

                                    </div>

                                     <div class="col-md-12 mb-3">
                                        <label for="">Sub Category Name</label>
                                        <input type="text" name="subname" value="<?= $row['subname']; ?>" class="form-control">
                                    </div> 
                                    <div class="col-md-12 mb-3">
                                        <label for="">Sub Category image</label>
                                        <img src="../uploads/sub/<?= $row['subimg']; ?>" height="100px" width="100px">
                                        <div class="alert alert-info" role="alert">
                                            Note: Please upload an image less than 2MB and only in JPG or PNG format.
                                        </div>
                                        <input type="hidden" name="oldimg" value="<?= $row['subimg']; ?>">
                                        <input type="file" name="scatimg"  class="form-control">
                                    </div> 
                                   <div id="alert-container"></div>
                                    <div class="col-md-12 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary" name="update-scat">Update Sub Category</button>
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
