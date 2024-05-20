<?php include'header.php';

if(isset($_SESSION['user_id'])) {
  $userid = $_SESSION['user_id'];
 
  $query = $conn->query("SELECT * FROM orders INNER JOIN orderstatus ON orders.orderstatus_id = orderstatus.ordersts_id WHERE user_id = $userid ORDER BY order_id DESC");

  if($query->num_rows>0) {


?>
<div class="app-content-area gradient-custom">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="">
                <h3 class="mt-4">Order List</h3>
              </div>
            </div>
          </div>
          <div>

            </div>

                  </div>
                  <div class="card-body mx-md-5 px-3 pb-5 pt-3">
                    <div class="table-responsive table-card">
                      <table class="table text-nowrap mb-0 table-centered">
                        <thead class="table-light">
                          <tr>

                            <th scope="col">Order ID</th>
                            <th scope="col" >Order Date</th>
                            <th scope="col" >Order Status</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Invoice Download</th>
                            <th scope="col">View</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($row = $query->fetch_assoc()) { 
                            $ordsts = $row['name'];?>
                          <tr class="p-2">

                            <td><?php echo $row['order_id'];?></td>
                            <td><?php echo $row['ord_date'];?></td>
                            <td ><?php echo $ordsts;?></td>
                            <td><?php if($ordsts == 'delivered') { echo $row['invoiceno']; } else { echo '-'; }?></td>
                            <td> 
                            <?php if($ordsts == 'delivered') { ?>
                            <form action="invoice.php" method="post">  
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                             <button type="submit" class="btn orderbtn" name="invoice" onclick="generatepdf();">Download</button></form>
                            <?php }else { ?>
                              <div class="ps-2"> - </div>
                            <?php }?>
                            </td>
                            <td>
                            <form action="productdetails.php" method="post">  
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                             <button type="submit" class="btn inc" name="view">View</button></form></td>
                             
                          </tr>
                          <?php }
                        ?>    
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
      <?php }
      else{
        ?>
    <div class="row ">
    <div class="col-xl-12 mt-5 mb-5">
  <div class="text-left logo p-1 px-5 mt-5" style="text-align:center;" ><img src="img\order.jpg" class='mb-2' style=" text-align:center; padding:2px; border-radius:30px;" width="100"><h5>No orders Found</h5> </div></div></div>
  <?php
      }
         }  
        ?>
      <?php include'footer.php';?>



      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
      <script>
        function generatepdf() {
          console.log('hello');
      const element = document.getElementById('invoice-content');
      html2pdf()
      .from(element)
      .save();
    }
      </script>