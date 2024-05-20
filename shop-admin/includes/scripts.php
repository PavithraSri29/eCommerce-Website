<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
         <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

<script>
   $(document).ready(function () {
        $('#subcategoriesTable').DataTable({
            "paging": true, 
            "pageLength": 10,
        });
        $('#productstable').DataTable({
            "paging": true, 
            "pageLength": 10, 
        });
        $('#cattable').DataTable({
            "paging": true, 
            "pageLength": 10, 
        });
    });
    $('#ppr, #pds').on('input', function () {
        var price = parseFloat($('#ppr').val()) || 0;
        var discount = parseFloat($('#pds').val()) || 0;

        // Calculate the Offer Price
        var offerPrice = (1 - discount / 100) * price;

        // Update the Offer Price input field
        $('#pofp').val(offerPrice.toFixed(2));
    });
</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#editors' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
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
