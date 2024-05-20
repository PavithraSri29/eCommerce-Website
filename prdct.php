<?php
    include("header.php");
    if(isset($_GET['id'])){
        $pid = $_GET['id'];
        $query = $conn->query("SELECT * FROM product WHERE p_id=$pid");
        $pres=$query->fetch_assoc();

    }
    // Initialize $is_in_wishlist based on whether the product is in the wishlist or not
$is_in_wishlist = false;
if(isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $check_wish = $conn->query("SELECT * FROM wishlist WHERE p_id='$pid' AND user_id='$userid'");
    $existing_wish = $check_wish->fetch_assoc();
    if($existing_wish) {
        $is_in_wishlist = true;
    }
}
 ?>   

<div class="container  p-3 g-3 bg-light" style="margin-top:60px;border-radius:15px;">
    <div class="row">
        <div class="col-lg-4">
            <img src="uploads/product/<?php echo $pres['pimg']; ?>" class="img-fluid" style="width:400px;" alt="Product Image">
        </div>
        <div class="col-lg-6">
            
            <h4><?php echo $pres['description']; ?></h4>
           
            <div class="d-flex align-items-center">
                    <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
                    <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
                    <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
                    <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
                    <span><i class="bi bi-star-fill text-muted"></i></span>
                    <small><span class="ms-2 text-danger">No ratings & reviews found</span></small>
                </div>

                <!-- <small>200+ bought in past month</small> -->
                <hr>
                <div class=" align-items-center">
                    
                    <h4 class="d-inline"><span class="text-danger  me-2">-<?php echo $pres['discount']; ?>%</span></h4> <!-- Discount percentage -->
                   <span class="text-dark  d-inline me-2 " > <h4 class="d-inline">₹<?php echo $pres['offerprice']; ?></h4></span> <!-- Discounted price -->
                    <span class="text-muted me-2 d-block my-2" style="font-size:12px;">M.R.P.:<del>₹<?php echo $pres['price']; ?></del></span> <!-- M.R.P. -->

                </div>
                <p >Inclusive of all taxes</p>


                <div class="row mb-3">
                  <div class="col-auto d-flex ">
                    <label for="quantity" class="form-label " style="margin-right:15px;">Quantity:</label>
                     
                      <!-- <form action="buy.php" method="post"> -->
                      <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="quantity" id="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select> 
                      <button type="button" class="heart" id="fav" onclick="wishlist(<?php echo $pres['p_id']; ?>)">
    <i class="bi <?php echo ($is_in_wishlist==true ? 'bi-heart-fill wishlist-check ' : 'bi-heart wishlist-uncheck'); ?>"></i>
</button>
                   </div>
                   
                </div>
                  <input type="hidden" name="productid" id="productid" value="<?php echo $pres['p_id']; ?>">
            <button type="button" name="adds" class="btn rounded-pill me-3 px-5 col-lg-4 mt-3 addtocart" onclick="addtocart()" ><i class="bi bi-cart-plus"></i> Add to Cart</button>
            <button type="button" name="buy" class="btn rounded-pill col-lg-4 mt-3 addtocart" style="padding: 6px 55px;" onclick="buynow()"><i class="bi bi-cart"></i> Buy Now</button>
     
        </div>
        
    </div>
</div>

<div class="container my-3 ">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="color:black;">Description</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="color:black;">Specification</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link " id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" style="color:black;">Rate & Review</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="mt-3">
    <?php echo $pres['description']; ?>
    </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <h5 class="mt-3">Product Specifications</h5>
        <table class="table table-bordered">
        <tbody>
            <?php echo $pres['specification']; ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <h5 class="mt-3">Customer Ratings</h5>
        <div class="d-flex align-items-center">
           <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
           <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
           <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
           <span class="me-2"><i class="bi bi-star-fill text-muted"></i></span>
           <span><i class="bi bi-star-fill text-muted"></i></span>
           <span class="ms-2">0.0 out of 5</span>
        </div>
        <div>
          <small class="text-danger">No ratings found</small>
        </div>

        <div>
          <h5 class= "mt-3">Customer Reviews</h5>
        </div>
        <div>
          <small class="text-danger">No reviews found</small>
        </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  
  function wishlist(productId) {
     var prod_id = productId;   
    $.ajax({
        type: 'POST',
        url: 'wishcode.php',
        data: {
            product_id: prod_id
        },
        dataType: 'json',
        success: function(result) {
        if (result.status == 'success') {
          
           if (result.is_in_wishlist) {
                        $("#fav i").removeClass("bi-heart wishlist-uncheck").addClass("bi-heart-fill wishlist-check");
                        Swal.fire({
                         
                           title: "Item added to wishlist"
  
                        });
                    } else {
                        $("#fav i").removeClass("bi-heart-fill wishlist-check").addClass("bi-heart wishlist-uncheck");
                        Swal.fire({
                          title: "Item removed from  wishlist"
  
                          });
                    }
                   
          $(".wishcount").html(result.wishcount);
        }
        else {
            alert(result.message);
            window.location.href = 'login.php';
        }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Error: " + errorThrown); 
    }
});
}
  function addtocart() {
     var quantity = document.getElementById('quantity').value;
     var prod_id = document.getElementById('productid').value;
    
    
    $.ajax({
        type: 'POST',
        url: 'cartcode.php',
        data: {
            quantity: quantity,
            product_id: prod_id
        },
        dataType: 'json',
        success: function(result) {
        if (result.status == 'success') {
          $(".cartcount").html(result.cartcount);
          Swal.fire({
                           icon:"success",
                           title: "Item added to Cart"
  
                        });
          // location.reload(); 
        }
        else {
            alert(result.message);
            window.location.href = 'login.php';
        }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Error: " + errorThrown); 
    }
});
}
function buynow() {
    var quantity = document.getElementById('quantity').value;
    var prodid = document.getElementById('productid').value;

    $.ajax({
        type: 'POST',
        url: 'buy.php',
        data: {
            quantity: quantity,
            productid: prodid
        },
        dataType: 'json',
        success: function(result) {
            if (result.status == 'success') {
                
                window.location.href = 'checkout.php';
            } else {
              alert(result.message);
            window.location.href = 'login.php';
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
}


 </script>

<?php
    include("footer.php");
 ?>  
