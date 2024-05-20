
<?php
        include 'header.php';
    ?>
    
 <section class=" text-light p-5 text-center text-sm-start mt-5  mb-4" style="background-color:rgb(49, 54, 63);">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-center">
                <div>
                    <h1>Welcome to <span class="shop">Shopie</span></h1>
                    <p class="lead my-4">"Elevate your online shopping experience with Shopie. From fashion to electronics, beauty to home essentials, we've got everything you need and more, all at your fingertips."</p>
                </div>
                <img class="img-fluid w-50 " src="img/device.svg" alt="">
            </div>
        </div>
  </section>

  <?php 
            $query=$conn->query("SELECT * from category where cat_sts=1");
           
                while($res=$query->fetch_assoc()){
                    $subcat=$conn->query("SELECT * from subcategory where sub_sts=1 and cat_id='".$res['cat_id']."'");
                
            ?>

  <section class="px-5 mb-3">
    <h3 class="mb-4 catname"> <?php echo ucfirst($res['cat_name']) ?></h3>
        <div class="carousel-wrapper">
          <div class="aaaa owl-carousel owl-theme">
                <?php
                while($subcat_res = $subcat->fetch_assoc()){
                ?>
                  <div >
                  <div class="card customcard" >
                    <a href="subcat.php?id=<?php echo $subcat_res["sub_id"]; ?>"><img class="card-img-top ecom-img" src="<?php echo "uploads/sub/".$subcat_res["subimg"]?>" alt="<?php echo ucfirst($subcat_res["subname"]);?>"></a> 
                    <div class="card-body custombody" id="blue" >
                    <a href="subcat.php?id=<?php echo $subcat_res["sub_id"]; ?>" class="text-decoration-none">
                      <h5 class="card-title text-center"><?php echo ucfirst($subcat_res["subname"]);?></h5></a>
                    </div>
                  </div>
                  </div>
                <?php
                }
                ?>            
            </div>
        </div>

  </section> 
<?php
                }
                ?>
 

  <?php
      include 'footer.php';
  ?>
  <script>
    $('.aaaa').owlCarousel({
              loop:true,
              margin:10,
              nav:true,
              navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
              dots:false,
              autoplay:true,
              autoplayTimeout:2000,
              autoplayHoverPause:true,
              mouseDrag: true,
              responsiveClass:true,
              responsive:{
                0:{
                items:1
                },
                576:{
                items:2
                },
                768:{
                items:2
                },
                992:{
                items:3
                },
                1200:{
                items:4
                }
              }
              });


  </script>
