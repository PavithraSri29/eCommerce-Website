<?php
include('header.php');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 24;
$start = ($page - 1) * $limit;
$product = $conn->query("SELECT * FROM product WHERE p_sts='1' ORDER BY RAND() LIMIT $start, $limit");
?>
<section class="px-5 py-4">
    <div class="row row-cols-1 row-cols-lg-4 g-4">
        <?php
        while ($allproduct = $product->fetch_assoc()) {
        ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col" >
                <div class="card h-100 customcard" id="products">
                    <a href="prdct.php?id=<?php echo $allproduct['p_id']; ?>"><img src="uploads/product/<?php echo $allproduct['pimg']; ?>" class="card-img-top" alt="..."></a>
                    <div class="card-body custombody" id="blue">
                        <a href="prdct.php?id=<?php echo $allproduct['p_id']; ?>" class="text-decoration-none">
                            <h5 class="card-text"><?php echo ucfirst($allproduct['p_name']); ?></h5>
                            <div>
                                <h6 class="d-inline"><span class="">&#8377;<?php echo $allproduct['offerprice']; ?></span></h6>
                                <small><span>M.R.P:</span>
                                    <span class=""><del>&#8377;<?php echo $allproduct['price']; ?></del></span>
                                    <span>&nbsp (<?php echo $allproduct['discount'] ?>&percnt;) </span>
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
    <?php
    
    $result = $conn->query("SELECT COUNT(*) AS total FROM product WHERE p_sts='1'");
    $row = $result->fetch_assoc();
    $total_pages = ceil($row['total'] / $limit);
    ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center  mt-4">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link pagenav" href="<?php if ($page > 1) echo "?page=" . ($page - 1); ?>" aria-label="Previous">
                    <span aria-hidden="true" >&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                <a class="page-link pagenav" href="<?php if ($page < $total_pages) echo "?page=" . ($page + 1); ?>" aria-label="Next">
                    <span aria-hidden="true" >&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
<?php
include 'footer.php';
?>
