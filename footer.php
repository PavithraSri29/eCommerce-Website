<footer id="footersection" class=" text-light py-5  g-4 " style="background-color:#222831;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h5>Who We Are</h5>
                <p>At Shopie, we're committed to providing top-quality products and exceptional service. With a focus on customer satisfaction, convenience, and reliability, we strive to redefine your shopping experience.</p>
            </div>
            <div class="col-lg-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li ><i class="bi bi-envelope fti"></i> &nbsp; <a class="text-decoration-none link-light" href="mailto:shopping@gmail.com"><p class="d-inline">shopie@gmail.com</p></a> </li>
                    <li class="mt-3"><i class="bi bi-telephone d-inline fti"></i>&nbsp; <a class="text-decoration-none link-light" href="tel:+1234567890"><p class="d-inline">+1234567890</p></a></li>
                    <li class="mt-3" ><i class="bi bi-geo-alt fti "></i>&nbsp; 123 Main Street, City, Country</li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5>Stay connected :</h5>
                
                  <a href="#"><i class="bi bi-twitter   mx-2 fti "></i></a>
                  <a href="#"><i class="bi bi-facebook   mx-2 fti"></i></a>
                  <a href="#"><i class="bi bi-linkedin   mx-2 fti"></i></a>
                  <a href="#"><i class="bi bi-instagram   mx-2 fti"></i></a>
          
            </div>

            <hr class="mt-3">

            <p class="text-white text-center mb-0">Copyrights &copy; 2024 All rights reserved by Shopie</p>
        </div>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
  const loaderEl = document.querySelector(".fullpage-loader");
   document.addEventListener("readystatechange", (event) => {
       const readyState = "complete";
       if (document.readyState === readyState) {
           setTimeout(() => {
               loaderEl.classList.add("fullpage-loader--invisible");
               setTimeout(() => {
                   loaderEl.style.pointerEvents = "none"; // Disables pointer events for the div
               }, 100);
           }, 500); // 10-second delay before hiding the loader
       }
   });
 </script>
<!-- <script>
    // Toggle dropdowns on click for mobile
    $(document).ready(function(){
      $('.navbar .dropdown-toggle').click(function(){
        if($(window).width() < 992){
          $(this).next('.dropdown-menu').toggle();
        }
      });
  
      // Toggle nested dropdowns
      $('.navbar .dropdown-submenu .dropdown-toggle').on('click', function(e){
        var $el = $(this).next('.dropdown-menu');
        $el.toggleClass('show'); // Toggle the 'show' class
        $(this).parent('.dropdown-submenu').siblings().find('.dropdown-menu').removeClass('show'); // Close other nested dropdowns
        e.stopPropagation();
      });
  
      // Close dropdowns when clicking outside
      $(document).on('click', function(event){
        var $trigger = $('.navbar .dropdown-toggle');
        if($trigger !== event.target && !$trigger.has(event.target).length){
          $(".navbar .dropdown-menu").hide();
        }            
      });
  
      // Close nested dropdowns when parent dropdown is closed
      $('.navbar .dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').removeClass('show');
      });
    });
  </script> -->

</body>
</html>