<?php 
include('shop-admin/config/db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <title>Shopie</title>
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css" >
  
</head>

<body>
<div class="loader-div fullpage-loader">
        <div class="preloader">
            <svg class="cart" role="img" aria-label="Shopping cart line animation" viewBox="0 0 128 128" width="128px"
                height="128px" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                    <g class="cart__track" stroke="hsla(0,10%,10%,0.1)">
                        <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
                        <circle cx="43" cy="111" r="13" />
                        <circle cx="102" cy="111" r="13" />
                    </g>
                    <g class="cart__lines" stroke="currentColor">
                        <polyline class="cart__top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80"
                            stroke-dasharray="338 338" stroke-dashoffset="-338" />
                        <g class="cart__wheel1" transform="rotate(-90,43,111)">
                            <circle class="cart__wheel-stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68"
                                stroke-dashoffset="81.68" />
                        </g>
                        <g class="cart__wheel2" transform="rotate(90,102,111)">
                            <circle class="cart__wheel-stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68"
                                stroke-dashoffset="81.68" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    <!-- Loader End -->
  <nav class="navbar navbar-expand-lg  navbar-dark py-3 fixed-top " style="background-color: #222831;">
    <div class="container">

      <a href="index.php" class="navbar-brand"><img src="img\shopielogo.png" style="width:135px;"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a href="index.php" class="nav-link navbars">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle navbars" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <?php 
            $query=$conn->query("SELECT * from category where cat_sts=1");
            ?>
            <ul class="dropdown-menu">
              <?php
                while($res=$query->fetch_assoc()){
                    $subcat=$conn->query("SELECT * from subcategory where sub_sts=1 and cat_id='".$res['cat_id']."'");
                ?>
              <li class="nav-item dropend">
                <a class="nav-link dropdown-toggle sub" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false" id="show">
                  <?php echo ucfirst($res['cat_name']) ?>
                </a>
                <ul class="dropdown-menu">
                  <?php
              while ($res_subcat = $subcat->fetch_assoc()) { 
                    ?>
                  <li><a href="subcat.php?id=<?php  echo $res_subcat['sub_id']; ?>" class="dropdown-item">
                      <?php echo ucfirst($res_subcat['subname']); ?>
                    </a></li>
                  <?php
                }
                ?>
                </ul>
              </li>
              <?php
                }
                ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="allproduct.php" class="nav-link navbars">Products</a>
          </li>
          <li class="nav-item">
            <a href="#footersection" class="nav-link navbars">About us</a>
          </li>
          
          <?php
                if(isset($_SESSION['user_id'])) {
                   
                    ?>
          <!-- <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li> -->
          <?php 
                    $userid=$_SESSION['user_id'];
                     $query = $conn->query("SELECT COUNT(*) AS count FROM cart WHERE user_id='$userid'");
                     $cartitem = $query->fetch_assoc()['count'];

  
                     $wish = $conn->query("SELECT COUNT(*) AS wish FROM wishlist WHERE user_id='$userid'");
                     $wishitem = $wish->fetch_assoc()['wish'];
                    ?>
           <li class="nav-item">
            <a href="wishlist.php" class="nav-link"><i class="bi bi-heart-fill hearti"></i><small><sup><span
             class="badge bg-danger text-white rounded-circle wishcount"
                  style="border-radius:10px;"><?php  echo $wishitem; ?></span><sup></small></a>
          </li> 
          <li class="nav-item">
            <a href="cart.php" class="nav-link"><i class="bi bi-cart4 "></i><small><sup><span 
                  class="badge bg-danger text-white rounded-circle cartcount" style="border-radius:10px; ">
                  <?php  echo $cartitem; ?>
                </span></sup></small></a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle navbars" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-person"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="account.php">My Account</a></li>
              <li><a class="dropdown-item" href="orders.php">Orders</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>

          <?php 
                }
                else{
                    ?>
          <li class="nav-item">
            <a href="login.php" class="nav-link navbars">Login/SignUp</a>
          </li>
          <!-- <li class="nav-item">
                        <a href="signup.php" class="nav-link">SignUp</a>
                    </li> -->
          <?php
                }
                ?>

                <li class="searchbox">
                  <form class="d-flex" role="search" action="searchproduct.php">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchinput"
                      oninput="searchprod()" name="searchinput" required>
                    <button class="btn search" type="submit" ><i class="bi bi-search"></i></button>
                  </form>
                  <ul id="searchResults"></ul>
                </li>
        </ul>
      </div>
    </div>
  </nav>
  


  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script>
    function searchprod() {
      var product = document.getElementById('searchinput').value;
    
      if (product.trim() !== '') {
        $.ajax({
          type: 'POST',
          url: 'searchcode.php',
          data: {
            product: product
          },
          dataType: 'json',
          success: function (result) {
            if (result.status == 'success') {
              $('#searchResults').empty();
              if (result.products.length > 0) {
                var productList = '';
                result.products.forEach(function (product) {
                  productList += '<li><a href="prdct.php?id=' + product.p_id + '">' + product.p_name + '</a></li>';
                });
                // productList += '</ul>';
                $('#searchResults').append(productList);
              } else {
                $('#searchResults').html('<p>No products found</p>');
              }
            } else {
              $('#searchResults').html('<p>' + result.message + '</p>');
            }
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
          }
        });
      }
      else {
        $('#searchResults').empty();
      }
    }
    // $(document).on('click', function(event) {
    //   if (!$(event.target).closest('#searchResults').length && !$(event.target).is('#searchinput')) {
    //       $('#searchResults').empty();
    //   }
    // });
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the search input and search results list
        var searchInput = document.getElementById('searchinput');
        var searchResults = document.getElementById('searchResults');

        // Add event listener to the document body
        document.body.addEventListener('click', function(event) {
            // Check if the click originated from within the search results
            var isClickInside = searchResults.contains(event.target) || searchInput.contains(event.target);

            // If not, hide the search results
            if (!isClickInside) {
                searchResults.style.display = 'none';
            }
            else{
              searchResults.style.display = 'block';
            }
        });
    });
</script>
