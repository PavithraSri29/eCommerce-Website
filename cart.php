<?php
include('header.php');

if(isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
    $query = $conn->query("SELECT p_id,quantity FROM cart WHERE user_id=$userid");
    $cs=$conn->query("SELECT COUNT(p_id) FROM cart WHERE user_id=$userid");
    $cse = $cs->fetch_assoc();
    if($query->num_rows>=1) {
      $products = array();
      $subtotal = 0;
      while($row = $query->fetch_assoc()) {
          $p_id = $row['p_id'];
          $quantity = $row['quantity'];
          $product_query = $conn->query("SELECT * FROM product WHERE p_id=$p_id");
          $product = $product_query->fetch_assoc();
           $product['quantity'] = $quantity; 
          $products[] = $product;
          $subtotal += $product['offerprice'] * $quantity;
         
      }
      $shipping_charge = ($subtotal < 1000) ? 50 : 100;
        $total_amount = $subtotal + $shipping_charge;
} 

}

else {
    echo '<script>alert("Please Login or SignUp to add this item to your cart.");';
    echo 'window.location.href="login.php";';
    echo '</script>';
    exit; 
}
if($cse['COUNT(p_id)']>0){
?>


<section class="h-100 gradient-custom">
  <div class="container pt-1">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header py-3 text-light carthead">
            <h5 class="mb-0">Cart - <?php echo $cse['COUNT(p_id)'];  ?> items</h5>
          </div>
          <div class="card-body">
          <?php foreach($products as $product): 
             $is_in_wishlist = false;
             $product_id=$product['p_id'];
             $check_wish = $conn->query("SELECT * FROM wishlist WHERE p_id='$product_id' AND user_id='$userid'");
             $existing_wish = $check_wish->fetch_assoc();
             if($existing_wish) {
               $is_in_wishlist = true;
         }
            ?>
            <!-- Single item -->
            <div class="row mt-3">
              <div class="col-lg-2 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                <img src="<?php echo 'uploads/product/' . $product['pimg']; ?>"
     class="w-100" alt="<?php echo $product['p_name']; ?>" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <div class="d-flex justify-content-start">
                <p><strong><?php echo ucfirst($product['p_name']); ?></strong></p></div>
                <p class="text-start">
                  <strong><?php echo '&#8377; ' . $product['offerprice']; ?></strong>
                </p>
                <div class="d-flex">
                <!-- <form action="removecart.php" method="post"> -->
                <button type="button" class="btn px-2 py-2 me-2 mb-2" style="font-size:24px;" name="del-prdct" onclick="delprdct(<?php echo $product['p_id']; ?>)">
                  <i class="bi bi-trash"></i>
                </button>
              <!-- </form> -->
              <button type="button" class="heart" id="heartBtn" onclick="wishlist(<?php echo $product['p_id']; ?>)">
    <i class="bi <?php echo ($is_in_wishlist==true ? 'bi-heart-fill wishlist-check ' : 'bi-heart wishlist-uncheck
    '); ?>  product_fill_<?php echo $product['p_id']; ?>" ></i>
</button>
</div>            <!-- Data -->
              </div>

<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
              <!-- Quantity -->
              <div class="d-flex mb-4" style="max-width: 300px;">
                          <!-- Decrease button -->
                          <button type="button" class="btn  px-2 py-2 me-2 inc" onclick="decreaseQuantity(<?php echo $product['p_id']?>,<?php echo $product['offerprice']?>)">
                              <i class="bi bi-dash"></i>
                          </button>

                          <!-- Quantity input (read-only) -->
                          <input id="quantityInput<?php echo $product['p_id']?>" readonly class="form-control form-control-lg" value="<?php echo $product['quantity']; ?>" aria-label="Quantity" />

                          <!-- Increase button -->
                          <button type="button" class="btn  px-2 py-2 ms-2 inc" onclick="increaseQuantity(<?php echo $product['p_id']?>,<?php echo $product['offerprice']?>)">
                              <i class="bi bi-plus"></i>
                          </button>
                      </div>
                    
                <p class="text-start text-md-center">
    <strong id="productTotal<?php echo $product['p_id']; ?>">
        <?php echo '&#8377; ' . ($product['offerprice'] * $product['quantity']); ?>
    </strong>
</p>
                
              </div>
            </div>
           
            <hr class="my-1" />
            <?php endforeach; ?>
          </div>
        </div>
      
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3 text-light carthead">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body ">
            <ul class="list-group">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Sub Total
                <span id="subtotal">  &#8377;<?php echo number_format($subtotal, 2); ?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                Shipping Price
                <span id="shipping_charge"> &plus; &#8377;<?php echo number_format($shipping_charge, 2); ?></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including shipping charge)</p>
                  </strong>
                </div>
                <span id="total_amount"><strong> &#8377; <?php echo number_format($total_amount, 2); ?></strong></span>
              </li>
            </ul>
            <a href="checkout.php">
            <button type="button" class="btn btn-lg btn-block inc">
              Go to checkout
            </button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
}
else{
  ?>
    <div class="row ">
    <div class="col-xl-12 mt-5 mb-5">
  <div class="text-left logo p-1 px-5 mt-5" style="text-align:center;" ><img src="img\cart.png" class='mb-2' style=" text-align:center; padding:2px; border-radius:30px;" width="100"><h5>Your Cart is Empty</h5> </div></div></div>
  <?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function updateSubtotalAndTotal() {
    var productTotals = document.querySelectorAll('[id^="productTotal"]');
    var subtotal = 0;

    productTotals.forEach(function(productTotal) {
        subtotal += parseFloat(productTotal.textContent.replace('₹', ''));
    });

    var shipping_charge = (subtotal < 1000) ? 50 : 100;
    var total_amount = subtotal + shipping_charge;

    document.getElementById('subtotal').textContent = '₹' + subtotal.toFixed(2);
    document.getElementById('shipping_charge').textContent = '₹' + shipping_charge.toFixed(2);
    document.getElementById('total_amount').textContent = '₹' + total_amount.toFixed(2);
}

  function increaseQuantity(productid, offerPrice) {
    var quantityInput = document.getElementById('quantityInput' + productid);
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    updateProductTotal(productid, offerPrice);
}

function decreaseQuantity(productid, offerPrice) {
    var quantityInput = document.getElementById('quantityInput' + productid);
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateProductTotal(productid, offerPrice);
    }
}

function updateProductTotal(productid, offerPrice) {
    var quantity = document.getElementById('quantityInput' + productid).value;
    var productTotal = quantity * offerPrice;
    document.getElementById('productTotal' + productid).innerHTML = '&#8377; ' + productTotal;

    $.ajax({
        type: 'POST',
        url: 'cartupdate.php',
        data: {
            quantity: quantity,
            product_id: productid
        },
        dataType: 'json',
        success: function(result) {
        if (result.status == 'success') {
            updateSubtotalAndTotal();
            
        }
        else {
            alert(result.message);
        }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Error: " + errorThrown); 
    }
});

}
function wishlist(productId) {
     var prod_id =  productId;
    $.ajax({
        type: 'POST',
        url: 'wishcode.php',
        data: {
            product_id: prod_id
        },
        dataType: 'json',
        success: function(result) {
        if (result.status == 'success') {         
           if (result.is_in_wishlist==true) {

            $(".product_fill_"+productId).removeClass("bi-heart wishlist-uncheck").addClass("bi-heart-fill wishlist-check");
                        Swal.fire({
                          
                           text: "Item added to wishlist"
  
                        });
                    } else {
                      $(".product_fill_"+productId).removeClass("bi-heart-fill wishlist-check").addClass("bi-heart wishlist-uncheck");
                        Swal.fire({
                            text: "Item removed from  wishlist"
  
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
function delprdct(productId) {
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, delete the product
                $.ajax({
                    type: 'POST',
                    url: 'removecart.php',
                    data: { product_id: productId },
                    dataType: 'json',
                    success: function(result) {
                      if (result.status == 'success') {
                        Swal.fire({
                            title: " Item Deleted!",
                            icon: "success"
                        }).then(() => {
                            
                            window.location.reload();
                        });
                    } else {
                        
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to delete the product.",
                            icon: "error"
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to delete the product.",
                        icon: "error"
                    });
                }
            });
        }
    });
}
 </script>
 
<?php
    include'footer.php';
?>