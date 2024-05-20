<?php
include('header.php');
    $searchin=$_GET['searchinput'];
$product =$conn->query("SELECT * FROM product WHERE p_name LIKE '%$searchin%' AND p_sts=1");
if($product->num_rows>0){
?>
<section class="px-5 mb-3">
    <div class="row row-cols-1 row-cols-lg-4 g-4"  style="margin-top:40px;">
        <?php
        while ($allproduct = $product->fetch_assoc()) {
        ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col" >
                <div class="card h-100" id="products">
                    <a href="prdct.php?id=<?php echo $allproduct['p_id']; ?>"><img src="uploads/product/<?php echo $allproduct['pimg']; ?>" class="card-img-top" alt="..."></a>
                    <div class="card-body " id="blue">
                        <a href="prdct.php?id=<?php echo $allproduct['p_id']; ?>" class="text-decoration-none">
                            <h5 class="card-text"><?php echo ucfirst($allproduct['p_name']); ?></h5>
                            <div>
                                <h6 class="d-inline"><span class="">&#8377;<?php echo $allproduct['offerprice']; ?></span></h6>
                                <small><span>M.R.P:</span>
                                    <span class=""><del>&#8377;<?php echo $allproduct['price']; ?></del></span>
                                    <span>&nbsp (<?php echo $allproduct['discount'] ?>&percnt;) </span>
                                </small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
 
   
</section>
<?php
}
else{
    ?>
    <div class="row ">
    <div class="col-xl-12 mt-5 mb-5">
  <div class="text-left logo p-1 px-5 mt-5 mb-4" style="text-align:center;" ><img src="img\wish.jpg" class='mb-2' style=" text-align:center; padding:px; border-radius:30px;" width="100"><h5>No Product Found </h5> </div></div></div>
  <?php
}
include 'footer.php';
    
    
?>
