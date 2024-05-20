<?php
  include'header.php';
  $userid = $_SESSION['user_id'];
  $users= $conn->query("SELECT * FROM users WHERE user_id=$userid");
  $userads= $conn->query("SELECT * FROM useraddress WHERE user_id=$userid");
  $user = $users->fetch_assoc();
?>
  

<section class="pt-3 pb-3">
  <div class="container">
    <div class="row">
    
        <div class="card shadow-0 border ">
          <div class="p-4">
            <h4 class="card-title mb-3"><i class="bi bi-person-fill"></i>  My Profile</h4>
            <form method="post" action="accountupdate.php">
            <div class="row">
              <div class="col-md-4 mb-3">
                <p class="mb-0">User Name</p>
                <div class="form-outline">
                  <input type="text" id="typeText" name="name" class="form-control" value="<?php echo $user['name']?>"/>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <p class="mb-0">Email</p>
                <div class="form-outline">
                  <input type="text" id="typeText" readonly class="form-control" value="<?php echo $user['email']?>"/>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <p class="mb-0">Phone</p>
                <div class="form-outline">
                  <input type="tel" id="typePhone" readonly  class="form-control" value="<?php echo $user['phoneno']?>" />
                </div>
              </div>

              <div class="col-md-4 mb-3 ">
                <p class="mb-0">DOB</p>
                <div class="form-outline">
                  <input type="date" id="dob" name="dob" class="form-control" value="<?php echo $user['dob']?>"/>
                </div>
              </div>

              <div class="col-md-4 mb-2">
                <p class="mb-0">Gender</p>
                <div class="container d-flex mt-2">
                  <div class="form-check ">
                    <input class="form-check-input " type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="male" <?php echo ($user['gender'] == 'male') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="flexRadioDefault1" >
                      Male
                    </label>
                  </div>
                  <div class="form-check ">
                    <input class="form-check-input" style="margin-left:10px;" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="female" <?php echo ($user['gender'] == 'female') ? 'checked' : ''; ?>>
                    <label class="form-check-label" style="margin-left:8px;" for="flexRadioDefault2">
                      Female
                    </label>
                  </div>
                </div>
                
              </div>
              <div class="text-center">
                <button class="btn btn-light border">Cancel</button>
                <button type="submit" class="btn shadow-0 border orderbtn"name="profile">Save</button>
                </div>
             </div>
          </div>
        </form>
    </div>
  </div>
</section>

<section class=" pb-3">
   <div class="container">
     <div class="row">
       <div class="card shadow-0 border ">
         <div class="p-4">
           <div class="d-flex justify-content-between">
              <h4 class="card-title mb-3">Address</h4><i class="fa fa-plus add" onclick="addNewAddressForm()"></i>
           </div>
           <div class="appending_div">
           <form method="post" action="accountupdate.php">
           <div class="address-form" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <div class="row">
              <div class="col-md-4 mb-3">
                <p class="mb-0">Doorno</p>
                <div class="form-outline">
                  <input type="text" id="doorno"  placeholder="#1/2A" class="form-control" name="doorno" />
                </div>
              </div>

              <div class="col-md-8 mb-3">
                <p class="mb-0">Street Name</p>
                <div class="form-outline">
                  <input type="text" id="street" placeholder="Masi Reddy lane" class="form-control" name="street"/>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                  <p class="mb-0">Area</p>
                  <div class="form-outline">
                    <input type="text" id="area" placeholder="Krishnaswami Nagar" class="form-control" name="area"/>
                  </div>
              </div>

              <div class="col-md-4 mb-3">
                  <p class="mb-0">City</p>
                  <div class="form-outline">
                    <input type="text" id="city" placeholder="washermenpet" class="form-control" name="city"/>
                  </div>
              </div>

              <div class="col-md-4 mb-3">
                  <p class="mb-0">Landmark</p>
                  <div class="form-outline">
                    <input type="text" id="landmark" placeholder="near sk super market" class="form-control" name="landmark"/>
                  </div>
                </div>
            </div>

            <div class="row">
              <div class=" col-md-3 mb-3">
                  <p class="mb-0">District</p>
                  <div class="form-outline">
                    <input type="text" id="district" placeholder="chennai" class="form-control" name="district"/>
                  </div>
              </div>

              <div class="col-md-3 mb-3">
                  <p class="mb-0">Pincode</p>
                  <div class="form-outline">
                    <input type="text" id="pincode" placeholder="600021" class="form-control" name="pincode"/>
                  </div>
              </div>

              <div class="col-md-3 mb-3">
                  <p class="mb-0">State</p>
                  <div class="form-outline">
                    <input type="text" id="state" placeholder="TamilNadu" class="form-control" name="state"/>
                  </div>
              </div>

              <div class="col-md-3 mb-3">
                  <p class="mb-0">Country</p>
                  <div class="form-outline">
                    <input type="text" id="country" placeholder="India" class="form-control" name="country"/>
                  </div>
              </div>
            </div>
            </div>
         </div>
            <!-- <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                <label class="form-check-label" for="flexCheckDefault1">Save this address</label>
            </div> -->
            <div class="text-center ">
                <button class="btn btn-light border">Cancel</button>
                <button type="submit" class="btn shadow-0 border orderbtn" name="address">Save</button>
            </div>
          </div>
          </form>
       </div>
     </div>
   </div>
</section>

<section class="pt-3 pb-5">
  <div class="container">
    <div class="row">
    
        <div class="card shadow-0 border ">
          <div class="p-4">
            <h4 class="card-title mb-3">Saved Address</h4>
            <?php while ($userad = $userads->fetch_assoc()){ ?>
            <div>
              <!-- Display each address -->
              <p><?php echo $userad['doorno']; ?>, <?php echo $userad['streetname']; ?>,<?php echo $userad['area']; ?>, <?php echo $userad['city']; ?>,<?php echo $userad['district']?>,<?php echo $userad['pincode']?>,<?php echo $userad['state']?>,<?php echo $userad['country']?></p>
            </div>
          <?php } ?>
            </div>
          </div>
    </div>
  </div>
</section>



<script>
  function addNewAddressForm() {
    var appendingDiv = document.querySelector('.appending_div');
    var addressForm = document.querySelector('.address-form');
    var cloneNode = addressForm.cloneNode(true);

    // Clear input values
    cloneNode.querySelectorAll('input').forEach(function(input) {
      input.value = '';
    });

    // Append the cloned form
    appendingDiv.appendChild(cloneNode);

    // Attach event listeners to buttons in the new form
    var cancelBtn = cloneNode.querySelector('.cancel');
    var saveBtn = cloneNode.querySelector('.save');
    cancelBtn.addEventListener('click', function() {
      this.closest('.address-form').remove(); // Remove the form when cancel button is clicked
    });
    saveBtn.addEventListener('click', function() {
      // Implement save functionality here
      console.log('Address saved');
    });
  }
</script>
<?php
  include'footer.php';
?>

