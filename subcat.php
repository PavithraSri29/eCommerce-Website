<?php
        include('header.php');
        if(isset($_GET['id'])){
            $subid = $_GET['id'];
            $query = $conn->query("SELECT * FROM product WHERE sub_id=$subid and p_sts=1");
            $subquery = $conn->query("SELECT subname FROM subcategory WHERE sub_id=$subid");
            $subres=$subquery->fetch_assoc();
            if ($query) {
        
    ?>

<section class="px-5 pb-5">
    <h1 class=" mb-3 pt-3"><?php echo ucfirst($subres['subname']); ?></h1>
    <div class="row row-cols-1 row-cols-lg-4 g-4">
    <?php
                    while($row = $query->fetch_assoc()){
                ?>
        <div class="col-lg-2 col-md-4 col-sm-6 col">
                
                    <div class="card h-100 customcard">                    
                        <a href="prdct.php?id=<?php  echo $row['p_id']; ?>"><img src="uploads/product/<?php echo $row['pimg']; ?>" class="card-img-top" alt="..."></a>
                        <div class="card-body custombody" id="blue">
                        <a href="prdct.php?id=<?php  echo $row['p_id']; ?>" class="text-decoration-none">
                            <h5 class="card-text"><?php echo ucfirst($row['p_name']); ?>
                            </h5>
                            <div>
                                <h6 class="d-inline"><span class="">&#8377;<?php echo $row['offerprice']; ?></span></h6>
                                <small><span>M.R.P:</span>
                                <span class=""><del>&#8377;<?php  echo $row['price']; ?></del></span>
                                <span>&nbsp (<?php echo $row['discount'] ?>&percnt;) </span>
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
        }
        ?>
<?php
  include 'footer.php';
?>
