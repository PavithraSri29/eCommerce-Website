<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Products</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Product</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Product</h4>
                    <a href="view-product.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id'])){
                        $pid = $_GET['id'];
                        $query = $conn->query("SELECT * FROM product WHERE p_id=$pid");
                        $subcat=$conn->query("SELECT * FROM subcategory ");
                        if ($query->num_rows > 0) {
                            $row = $query->fetch_assoc();
                            ?>
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="pid" value="<?=$row['p_id'];?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Select Sub Category</label>
                                        <select name="scatname" class="form-control">
                                            <option value="" class="active">--Select Sub Category-- </option>
                                            <?php
                                                while($res_subcat=$subcat->fetch_assoc()){ ?>
                                                <option value="<?php echo $res_subcat['sub_id']?>" <?php echo $res_subcat['sub_id']==$row['sub_id'] ?'selected':''?> ><?php echo $res_subcat['subname']?></option>
                                            <?php   
                                             }
                                            ?>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <label for="">Product Name</label>
                                               <input type="text" name="pname" value="<?= $row['p_name']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-5 ">
                                       <label for="">Description</label>
                                               <textarea  id="editors" name="pdesc"  class="form-control h-100" rows="5"><?= $row['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <label for="">Specification</label>
                                               <textarea id="editor" name="pspe" class="form-control" rows="5"><?= $row['specification']; ?></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Product Image</label>
                                        <img src="../uploads/product/<?= $row['pimg']; ?>" height="100px" width="100px">
                                        <input type="hidden" name="oldimg" value="<?= $row['pimg']; ?>">
                                        <input type="file" name="pimg" class="form-control">
                                    </div>
                                    <div class="alert alert-info col-md-6 mt-4 mb-4" role="alert">
                                            Note: Please upload an image less than 2MB and only in JPG or PNG format.
                                        </div>
                                    <div class="col-md-3 mb-3">
                                       <label for="">Price</label>
                                       <div class="input-group">
                                       <span class="input-group-text bg-dark text-light"><i class="bi bi-currency-rupee"></i></span>
                                               <input type="text" name="pprice" value="<?= $row['price']; ?>" class="form-control" id="ppr">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label for="">Discount</label>
                                       <div class="input-group">
                                               <input type="text" name="pdis" value="<?= $row['discount']; ?>" class="form-control" id="pds">
                                               <span class="input-group-text bg-dark text-light">%</span>
                                            </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label for="">Offer Price</label>
                                       <div class="input-group">
                                       <span class="input-group-text bg-dark text-light"><i class="bi bi-currency-rupee"></i></span>
                                               <input type="text" name="pofp" value="<?= $row['offerprice']; ?>" class="form-control" id="pofp" readonly>
                                            </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                       <label for="">Stock</label>
                                               <input type="text" name="pqty" value="<?= $row['stock']; ?>" class="form-control">
                                    </div>
                                   
                                    <div class="col-md-12 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary" name="update-p">Update product</button>
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
