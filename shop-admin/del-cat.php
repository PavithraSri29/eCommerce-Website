<?php
if (isset($_GET['cat_id'])) {
    $catid = $_GET['cat_id'];

    include('config/db.php'); 
    
    $deleteProductsQuery = $conn->query("DELETE FROM product WHERE sub_id IN (SELECT sub_id FROM subcategory WHERE cat_id='$catid')");

    if ($deleteProductsQuery) {
       
        $deleteSubcategoriesQuery = $conn->query("DELETE FROM subcategory WHERE cat_id='$catid'");

        if ($deleteSubcategoriesQuery) {
          
            $deleteCategoryQuery = $conn->query("DELETE FROM category WHERE cat_id='$catid'");

            if ($deleteCategoryQuery) {
                $_SESSION['message'] = "Category, related subcategories, and products Deleted Successfully";
                header("location:view-category.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Category is not deleted!";
                header("location:view-category.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Error deleting subcategories!";
            header("location:view-category.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Error deleting products!";
        header("location:view-category.php");
        exit(0);
    }
} else {
   
    header("location:view-category.php");
    exit(0);
}
?>
