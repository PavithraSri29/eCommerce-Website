<?php include 'header.php'; 
$userid = $_SESSION['user_id'];
$userads= $conn->query("SELECT * FROM useraddress WHERE user_id=$userid");

$userAddresses = [];
while ($row = $userads->fetch_assoc()) {
    $userAddresses[] = $row;
}
$price = 0;
$discount = 0;
$offerprice = 0;
$shipping_charge = 0;
$total_amount = 0;
$query = $conn->query("SELECT p_id,quantity FROM cart WHERE user_id=$userid");
$cs=$conn->query("SELECT COUNT(p_id) FROM cart WHERE user_id=$userid");
$cse = $cs->fetch_assoc();
while($row = $query->fetch_assoc()) {
$p_id = $row['p_id'];
$quantity = $row['quantity'];
$product_query = $conn->query("SELECT * FROM product WHERE p_id=$p_id");
$product = $product_query->fetch_assoc();
$price += $product['price'] * $quantity;
$discount += ($product['price'] -$product['offerprice'])* $quantity;
$offerprice+=$product['offerprice']* $quantity;
}
$shipping_charge = ($offerprice < 1000) ? 50 : 100;
$total_amount = $offerprice + $shipping_charge;
if($cse['COUNT(p_id)']>0){
if ($userads->num_rows > 0) {
?>

<section class="gradient-custom py-4">
  
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mb-4">
       
        <div class="card shadow-0 border">
        <form id="checkoutForm" method="post">
          <div class="p-4">
              <h5 class="card-title mb-3">Checkout Page</h5>
             <div class="row">
             
                <div class="card" style="padding-right:0px; padding-left:0px;">
                  <div class="card-header">
                      Shipping Address
                  </div>
                  <div class="card-body">
                    
                        <div class=" mb-3" id="shippingAddress">
                            <!-- <label for="shippingAddress" class="form-label">Address</label> -->
                            <select class="form-select" name="shippingaddress" id="shipping"aria-label="Default select example" >
                            <option value="">Select an Address</option>
                            <?php foreach ($userAddresses as $userAddress): ?>
                            <option value="<?php echo $userAddress['address_id']; ?>"><?php echo $userAddress['doorno']; ?>, <?php echo $userAddress['streetname']; ?>,
                        <?php echo $userAddress['area']; ?>, <?php echo $userAddress['city']; ?>,
                         <?php echo $userAddress['district']?>,
                        <?php echo $userAddress['pincode']?>, <?php echo $userAddress['state']?>,
                        <?php echo $userAddress['country']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                    
                  </div>
               </div>
               
               <div class="card mt-2" style="padding-right:0px; padding-left:0px;">
                  <div class="card-header">
                      Billing Address
                  </div>
                  <div class="card-body">
                   
                    <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="sameAsShipping">
                            <label class="form-check-label" for="sameAsShipping">
                                Same as shipping Address
                            </label>
                        </div>
                        <div class="mb-3" id="billingAddress" >
                            <select class="form-select" name="billingaddress"  id="billing" aria-label="Default select example">
                            <option value="">Select an Address</option>
                            <?php foreach ($userAddresses as $userAddress): ?>
                            <option value="<?php echo $userAddress['address_id']; ?>"><?php echo $userAddress['doorno']; ?>, <?php echo $userAddress['streetname']; ?>,
                        <?php echo $userAddress['area']; ?>, <?php echo $userAddress['city']; ?>,
                        <?php echo $userAddress['landmark']?>, <?php echo $userAddress['district']?>,
                        <?php echo $userAddress['pincode']?>, <?php echo $userAddress['state']?>,
                        <?php echo $userAddress['country']?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                   
                  </div>
               </div>
             </div>

              <h4 class="mb-3 mt-3">Payment</h4>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="cod" name="paymentMethod" type="radio" class="custom-control-input" value="cashondelivery">
                  <label class="custom-control-label" for="credit">Cash On Delivery Only</label>
                </div>
              </div>

              <!-- Buttons -->
              <div class="text-center">
                
                <button  type="submit" name="orders" class="btn  shadow-0 border orderbtn" style="align-items:center;">Place Order</button></a>
              </div>
              
           </div>
          </form>
        </div>
        <!-- Checkout -->
      </div>

      <div class="card shadow-0 border col-lg-4 d-flex">
        <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">

          <!-- Summary -->
          
          <div class="d-flex justify-content-between align-items-center mb-md-2 mt-md-3">
            <h5 class="mb-3 mt-3">Summary</h5>
                
                <a href="cart.php" style="text-decoration:none;"><button class="btn shadow-0 border d-flex justify-content-center orderbtn" style="height: 40px;">Change</button></a>
              </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Price:</p>
            <p class="mb-2">&#8377;<?php echo number_format($price, 2); ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Discount:</p>
            <p class="mb-2 text-danger">&minus; &#8377;<?php echo number_format($discount, 2); ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Offer Price:</p>
            <p class="mb-2">&#8377;<?php echo number_format($offerprice, 2); ?></p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="mb-2">Shipping cost:</p>
            <p class="mb-2"> &plus; &#8377;<?php echo number_format($shipping_charge, 2); ?></p>
          </div>
          <hr />
          <div class="d-flex justify-content-between">
            <p class="mb-2">Total price:</p>
            <p class="mb-2 fw-bold">&#8377;<?php echo number_format($total_amount, 2); ?></p>
          </div>
         
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> 
                      <a href="checkout.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
                    </div>                                          
                    <div class="modal-body">
                    <div class="row ">
                                  <div class="col-xl-12 ">
                              <div class="text-left logo p-2 px-5 " style="text-align:center;" > <img src="https://i.imgur.com/2zDU056.png" class='mb-2' style="background-color:rgb(78, 241, 52 ); text-align:center; padding:5px; border-radius:30px;" width="50"> <h5>Your order Confirmed!</h5> </div></div></div>
                    
                              <div class="row ">
                                  <div class="col-xl-12 ">
                              <div class="text-center  " style="text-align:center;" > Order ID: <a href="" class="text-decoration-none orderid"></a> </div></div></div>
                          
                               <div class="row text-center mt-3">
                                  <div class="col-xl-12 ">
                                  <a href="orders.php"><button type="button" class="btn orderbtn">OK</button></a>
                              </div></div> 
                              
                    </div>
                  </div>
                </div>
              </div>


    </div>
  </div>
</section>
<?php
} else {
   
    echo '<script>alert("Please add your address in your profile."); window.location.href = "account.php";</script>';
}
}
else{ ?>
<div class="row ">
    <div class="col-xl-12 mt-5 mb-5">
  <div class="text-left logo p-1 px-5 mt-5" style="text-align:center;" ><img src="img\cart.png" class='mb-2' style=" text-align:center; padding:2px; border-radius:30px;" width="100"><h5>No items added in Cart</h5> </div></div></div>
  <?php
}
?>
<?php include 'footer.php'; ?>
<script>
 document.getElementById('sameAsShipping').addEventListener('change', function() {
    if (this.checked) {
       
        var selectedShippingAddress = document.querySelector('#shippingAddress select').value;
        
        document.querySelector('#billingAddress select').value = selectedShippingAddress;
    }
});
document.querySelector('#shippingAddress select').addEventListener('change', function() {
    
    document.getElementById('sameAsShipping').checked = false;

    document.querySelector('#billingAddress select').value = '';
});
document.querySelector('#billingAddress select').addEventListener('change', function() {
    
    document.getElementById('sameAsShipping').checked = false;

});

</script>

<script>

$(document).ready(function() {
            

        $("#checkoutForm").validate({
            rules: {
                 shippingaddress: {
                    required: true
                },
                billingaddress: {
                    required: true
                    
                },
                paymentMethod:{
                    required:true
                   
                }
            },
            messages: {
                shippingaddress: {
                    required :"Shipping address can't be empty"
                },
                billingaddress: {
                    required :"Billing address can't be empty"
                   
                },
                
                paymentMethod:{
                    required:"Choose Payment method"
                    
                }
            },
            submitHandler: function(form) {
            
            var shippingaddress = document.getElementById('shipping').value;
            var billingaddress = document.getElementById('billing').value;
            var paymentmethod = document.getElementById('cod').value;
            $.ajax({
                type: 'POST',
                url: 'ordercode.php',
                data: {shippingaddress: shippingaddress,
                       billingaddress: billingaddress,
                      paymentmethod: paymentmethod}, 
                dataType: 'json',
                success: function(result) {
                    if (result.status == 'success') {
                     
                        $('#exampleModal').modal('show');
                        $(".orderid").html(result.orderid);
                    } else {
                       
                        alert(result.message);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Error: " + errorThrown);
                }
            });
            return false; 
        }
    });
});
  </script>

