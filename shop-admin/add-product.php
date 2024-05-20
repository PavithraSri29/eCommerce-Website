<?php
include ('config/db.php');
include ('includes/header.php');
include ('log.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Manage Products</h3>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Products</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                    <a href="view-product.php" class="btn btn-danger float-end">Back</a>
                </div>
                <div class="card-body">
                <?php 
                     $subcat=$conn->query("SELECT * FROM subcategory ");
                    ?>
                <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <label for="">Select Sub Category </label>
                                        <select name="scatname" class="form-control">
                                            <option value="" class="active">--Select Sub Category-- </option>
                                            <?php
                                                while($res_scat=$subcat->fetch_assoc()){ ?>
                                                <option value="<?php echo $res_scat['sub_id']?>" ><?php echo $res_scat['subname']?></option>
                                            <?php   
                                             }
                                            ?>
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Product Name </label>
                                        <input type="text" name="pname" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Product Image</label>
                                        <input type="file" name="pimg" class="form-control">
                                    </div>
                                    <div class="alert alert-info col-md-6" role="alert">
                                            Note: Please upload an image less than 2MB and only in JPG or PNG format.
                                        </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="">Description</label>
                                        <textarea  id="editors" name="pdesc" class="form-control h-75" ></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Specification </label>
                                        <textarea id="editor" name="pspe" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="">Price </label>
                                        <div class="input-group">
                                        <span class="input-group-text bg-dark text-light"><i class="bi bi-currency-rupee"></i></span>
                                        <input type="text" name="pprice" class="form-control" id="ppr">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                      <label for="">Discount</label>
                                         <div class="input-group">
                                                <input type="text" name="pdis" class="form-control" value="0" id="pds">
                                                 <span class="input-group-text bg-dark text-light">%</span>
                                         </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="">Offer Price </label>
                                        <div class="input-group">
                                        <span class="input-group-text bg-dark text-light"><i class="bi bi-currency-rupee"></i></span>
                                        <input type="text" name="pofprice" class="form-control" id="pofp" readonly>
                                       </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="">Stock </label>
                                        <input type="text" name="pqty" class="form-control">
                                    </div>
                                   
                                    <div class="col-md-12 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary" name="add-p">Add Product</button>
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
