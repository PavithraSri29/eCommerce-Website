<?php
include('header.php');
if(isset($_SESSION['user_id'])) {
 $userid = $_SESSION['user_id'];
$product =$conn->query("SELECT * FROM wishlist WHERE user_id='$userid'");
$cs=$conn->query("SELECT COUNT(p_id) FROM wishlist WHERE user_id=$userid");
    $cse = $cs->fetch_assoc();
}
if($cse['COUNT(p_id)']>0){
?>
<section class="px-5 py-4">
    <div class="row row-cols-1 row-cols-lg-4 g-4">
        <?php
       while($row = $product->fetch_assoc()) {
        $p_id = $row['p_id'];
        $product_query = $conn->query("SELECT * FROM product WHERE p_id='$p_id'");
          $products = $product_query->fetch_assoc();
        ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col" >
                <div class="card h-100 customcard" id="products">
                    <a href="prdct.php?id=<?php echo $products['p_id']; ?>"><img src="uploads/product/<?php echo $products['pimg']; ?>" class="card-img-top" alt="..."></a>
                    <div class="card-body custombody" id="blue">
                        <a href="prdct.php?id=<?php echo $products['p_id']; ?>" class="text-decoration-none">
                            <h5 class="card-text"><?php echo ucfirst($products['p_name']); ?></h5>
                            <div>
                                <h6 class="d-inline"><span class="">&#8377;<?php echo $products['offerprice']; ?></span></h6>
                                <small><span>M.R.P:</span>
                                    <span class=""><del>&#8377;<?php echo $products['price']; ?></del></span>
                                    <span>&nbsp (<?php echo $products['discount'] ?>&percnt;) </span>
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
  <div class="text-left logo p-1 px-5 mt-5 mb-4" style="text-align:center;" ><img src="img\wish.jpg" class='mb-2' style=" text-align:center; padding:px; border-radius:30px;" width="100"><h5>Your Wishlist is Empty</h5> </div></div></div>
  <?php
}
include 'footer.php';
    
    
?>

