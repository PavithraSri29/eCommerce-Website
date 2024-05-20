<?php
if (isset($_GET['sub_id'])) {
    $scatid = $_GET['sub_id'];

    include('config/db.php'); 

    $deleteProductsQuery = $conn->query("DELETE FROM product WHERE sub_id='$scatid'");

    if ($deleteProductsQuery) {
      
        $deleteSubcategoryQuery = $conn->query("DELETE FROM subcategory WHERE sub_id='$scatid'");

        if ($deleteSubcategoryQuery) {
            $_SESSION['message'] = "Sub Category and related products Deleted Successfully";
            header("location:view-subcategory.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Sub Category is not deleted!";
            header("location:view-subcategory.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Error deleting products!";
        header("location:view-subcategory.php");
        exit(0);
    }
} else {
    $_SESSION['message'] = "Error";
    header("location:view-subcategory.php");
    exit(0);
}
?>
