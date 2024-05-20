<?php
include('config/db.php');
include('log.php');

if (isset($_POST['del-cat'])) {
    $catid = $_POST['del-cat'];

    $subcatCount = $conn->query("SELECT COUNT(*) FROM subcategory WHERE cat_id='$catid'")->fetch_row()[0];
    $productCount = $conn->query("SELECT COUNT(*) FROM product WHERE sub_id IN (SELECT sub_id FROM subcategory WHERE cat_id='$catid')")->fetch_row()[0];

    if ($subcatCount > 0 || $productCount > 0) {
        echo "<script>
            var confirmDelete = confirm('This category has $subcatCount subcategories and $productCount products. Are you sure you want to delete it?');
            if (confirmDelete) {
                
                window.location.href = 'del-cat.php?cat_id=$catid';
            } else {
               
                window.location.href = 'view-category.php';
            }
          </script>";
    } else {
        $query = $conn->query("DELETE FROM category WHERE cat_id='$catid'");

        if ($query) {
            $_SESSION['message'] = "Category Deleted Successfully";
            header("location:view-category.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Category is not deleted!";
            header("location:view-category.php");
            exit(0);
        }
    }
}

if (isset($_POST['sts-cat'])) {
    $catid = $_POST['sts-cat'];

    $currentStatus = getCategoryStatus($catid);
    $newStatus = ($currentStatus == 1) ? 0 : 1;


    $updateCategoryQuery = $conn->query("UPDATE category SET cat_sts='$newStatus' WHERE cat_id='$catid'");

    if ($updateCategoryQuery) {
        $updateSubcategoriesQuery = $conn->query("UPDATE subcategory SET sub_sts='$newStatus' WHERE cat_id='$catid'");

        $updateProductsQuery = $conn->query("UPDATE product
                                            SET p_sts='$newStatus'
                                            WHERE sub_id IN (SELECT sub_id FROM subcategory WHERE cat_id='$catid')");

        if ($updateSubcategoriesQuery && $updateProductsQuery) {
            $_SESSION['message'] = "Category and related Sub Categories, Product status updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update subcategories or products status.";
        }
    } else {
        $_SESSION['error'] = "Failed to update category status.";
    }

    header("location:view-category.php");
    exit(0);
}

function getCategoryStatus($catid) {
    global $conn;
    $statusQuery = $conn->query("SELECT cat_sts FROM category WHERE cat_id='$catid'");
    $row = $statusQuery->fetch_assoc();
    return $row['cat_sts'];
}


if (isset($_POST['add-cat'])){
    $catname = $_POST['catname'];
    $catdes = $_POST['catdesc'];
    $query=$conn->query("INSERT INTO category(cat_name,cat_des)VALUES('$catname','$catdes')");

    if($query){
        $_SESSION['message'] = "Category Added Successfully";
        header("location:view-category.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Category is not Added";
        header("location:view-category.php");
        exit(0);
    }
}

if (isset($_POST['update-cat'])) {
     $catid = $_POST['catid'];
    $catname = $_POST['catname'];
    $catdes = $_POST['catdesc'];

    $stmt = $conn->prepare("UPDATE category SET cat_name=?, cat_des=? WHERE cat_id=?");

    $stmt->bind_param("ssi", $catname, $catdes, $catid);

    if ($stmt->execute()) {
        $_SESSION['message'] = " Category Updated Successfully";
        header("location:view-category.php");
        exit(0);
    } else {
        $_SESSION['error'] = " Category Update Failed: " . $stmt->error;
        header("location:view-category.php");
        exit(0);
    }
    $stmt->close();
}
if (isset($_POST['del-p'])) {
    $pid = $_POST['del-p'];
    $query = $conn->query("DELETE FROM product WHERE p_id='$pid'");

    if ($query) {
        $_SESSION['message'] = "Product Deleted Successfully";
        header("location:view-product.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Product is not deleted!";
        header("location:view-product.php");
        exit(0);
    }
}
if (isset($_POST['sts-p'])) {
    $pid = $_POST['sts-p'];

    $statusQuery = $conn->query("SELECT p_sts FROM product WHERE p_id='$pid'");
    
    if ($statusQuery) {
        $currentStatus = $statusQuery->fetch_assoc()['p_sts'];

        $newStatus = ($currentStatus == 1) ? 0 : 1;

        $updateQuery = $conn->query("UPDATE product SET p_sts='$newStatus' WHERE p_id='$pid'");

        if ($updateQuery) {
            $_SESSION['message'] = "Product status updated successfully";
            header("location:view-product.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Failed to update product status";
            header("location:view-product.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Failed to fetch product status";
        header("location:view-product.php");
        exit(0);
    }
}
if (isset($_POST['add-p'])) {
    $pname = $_POST['pname'];
    $ppr = $_POST['pprice'];
    $pdes = $_POST['pdesc'];
    $pspe = $_POST['pspe'];
    $pofp = $_POST['pofprice'];
    $pdis = $_POST['pdis'];
    $pqty = $_POST['pqty'];
    $scatid = $_POST['scatname'];
    $image = $_FILES['pimg']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;

    $file_size = $_FILES['pimg']['size']; 
    $max_size = 2 * 1024 * 1024; 

    if ($file_size > $max_size) {
        $_SESSION['message'] = "Image size exceeds 2MB. Please choose a smaller image.";
        header("location:view-product.php");
        exit(0);
    } elseif (!in_array($image_extension, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['message'] = "Invalid image format. Please choose a JPG or PNG image.";
        header("location:view-product.php");
        exit(0);
    }

    $query = $conn->query("INSERT INTO product(p_name, sub_id, price, pimg, description, specification, discount, offerprice, quantity, p_sts) VALUES('$pname', '$scatid', '$ppr', '$filename','$pdes','$pspe','$pdis','$pofp','$pqty',1)");

    if ($query) {
        move_uploaded_file($_FILES['pimg']['tmp_name'], '../uploads/product/' . $filename);
        $_SESSION['message'] = "Product Added Successfully";
        header("location:view-product.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Product is not Added";
        header("location:view-product.php");
        exit(0);
    }
}


if (isset($_POST['update-p'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $ppr = $_POST['pprice'];
    $pdes = $_POST['pdesc'];
    $pspe = $_POST['pspe'];
    $pofp = $_POST['pofp'];
    $pdis = $_POST['pdis'];
    $pqty = $_POST['pqty'];
    $scatid = $_POST['scatname'];
    $image = $_FILES['pimg']['name'];
    $oldfilename = $_POST['oldimg'];
    $updatefilename = "";

    if ($image != NULL) {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_extension;
        $updatefilename = $filename;

        $file_size = $_FILES['pimg']['size']; 
        $max_size = 2 * 1024 * 1024; 

        if ($file_size > $max_size) {
            $_SESSION['message'] = "Image size exceeds 2MB. Please choose a smaller image.";
            header("location:view-product.php");
            exit(0);
        } elseif (!in_array($image_extension, ['jpg', 'jpeg', 'png'])) {
            $_SESSION['message'] = "Invalid image format. Please choose a JPG or PNG image.";
            header("location:view-product.php");
            exit(0);
        }
    } else {
        $updatefilename = $oldfilename;
    }

    $stmt = $conn->prepare("UPDATE product SET p_name=?, pimg=?, description=?, specification=?, price=?, discount=?, offerprice=?, stock=?, sub_id=? WHERE p_id=?");

    $stmt->bind_param("ssssdddsii", $pname, $updatefilename, $pdes, $pspe, $ppr, $pdis, $pofp, $pqty, $scatid, $pid);

    if ($stmt->execute()) {
        if ($image != NULL) {
            if (file_exists('../uploads/product/' . $oldfilename)) {
                unlink('../uploads/product/' . $oldfilename);
            }
            move_uploaded_file($_FILES['pimg']['tmp_name'], '../uploads/product/' . $updatefilename);
        }
        $_SESSION['message'] = "Product Updated Successfully";
        header("location:view-product.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Product Update Failed";
        header("location:view-product.php");
        exit(0);
    }

    $stmt->close();
}

if (isset($_POST['del-scat'])) {
    $scatid = $_POST['del-scat'];
    
    $productCount = $conn->query("SELECT COUNT(p_id) as productcount FROM product WHERE sub_id='$scatid'")->fetch_row()[0];

    if ($productCount > 0) {
        
        echo "<script>
                var confirmDelete = confirm('This sub category has $productCount products. Are you sure you want to delete it?');
                if (!confirmDelete) {
                   
                    window.location.href = 'view-subcategory.php';
                } else {
                   
                    window.location.href = 'del-scat.php?sub_id=$scatid';
                }
              </script>";
    } else {
        
        $deleteCategoryQuery = $conn->query("DELETE FROM subcategory WHERE sub_id='$scatid'");

        if ($deleteCategoryQuery) {
            $_SESSION['message'] = "Sub Category Deleted Successfully";
            header("location:view-subcategory.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Sub Category is not deleted!";
            header("location:view-subcategory.php");
            exit(0);
        }
    }
}
if (isset($_POST['sts-scat'])) {
    $scatid = $_POST['sts-scat'];

    $statusQuery = $conn->query("SELECT sub_sts FROM subcategory WHERE sub_id='$scatid'");
    
    if ($statusQuery) {
        $currentStatus = $statusQuery->fetch_assoc()['sub_sts'];

        $newStatus = ($currentStatus == 1) ? 0 : 1;

        $updateQuery = $conn->query("UPDATE subcategory SET sub_sts='$newStatus' WHERE sub_id='$scatid'");

        if ($updateQuery) {
            $updateProductQuery = $conn->query("UPDATE product SET p_sts='$newStatus' WHERE sub_id='$scatid'");

            if ($updateProductQuery) {
                $_SESSION['message'] = "Sub Category status and related products updated successfully";
                header("location:view-subcategory.php");
                exit(0);
            } else {
                $_SESSION['error'] = "Failed to update related products status";
                header("location:view-subcategory.php");
                exit(0);
            }
        } else {
            $_SESSION['error'] = "Failed to update subcategory status";
            header("location:view-subcategory.php");
            exit(0);
        }
    } else {
        $_SESSION['error'] = "Failed to fetch subcategory status";
        header("location:view-subcategory.php");
        exit(0);
    }
}

if (isset($_POST['add-scat'])) {
    $scatname = $_POST['scatname'];
    $catid = $_POST['catname'];
    $image = $_FILES['scatimg']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_extension;

    $file_size = $_FILES['scatimg']['size']; 
    $max_size = 2 * 1024 * 1024; 

    if ($file_size > $max_size) {
        $_SESSION['message'] = "Image size exceeds 2MB. Please choose a smaller image.";
        header("location:view-subcategory.php");
        exit(0);
    } elseif (!in_array($image_extension, ['jpg', 'jpeg', 'png'])) {
        $_SESSION['message'] = "Invalid image format. Please choose a JPG or PNG image.";
        header("location:view-subcategory.php");
        exit(0);
    }

    $query = $conn->query("INSERT INTO subcategory(subname, cat_id, subimg,sub_sts) VALUES('$scatname', '$catid', '$filename',1)");

    if ($query) {
        move_uploaded_file($_FILES['scatimg']['tmp_name'], '../uploads/sub/' . $filename);
        $_SESSION['message'] = "Sub Category Added Successfully";
        header("location:view-subcategory.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Sub Category is not Added";
        header("location:view-subcategory.php");
        exit(0);
    }
}

if (isset($_POST['update-scat'])) {
    $scatid = $_POST['scatid'];
    $scatname = $_POST['subname'];
    $catid = $_POST['catname'];
    $image = $_FILES['scatimg']['name'];
    $oldfilename = $_POST['oldimg'];
    $updatefilename = "";

    if (!empty($image)) {
        // New image is selected
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_extension;
        $updatefilename = $filename;

        $file_size = $_FILES['scatimg']['size']; 
        $max_size = 2 * 1024 * 1024; 

        if ($file_size > $max_size) {
            $_SESSION['message'] = "Image size exceeds 2MB. Please choose a smaller image.";
            header("location:view-subcategory.php");
            exit(0);
        } elseif (!in_array($image_extension, ['jpg', 'jpeg', 'png'])) {
            $_SESSION['message'] = "Invalid image format. Please choose a JPG or PNG image.";
            header("location:view-subcategory.php");
            exit(0);
        }
    } else {
        // No new image selected, keep the old image
        $updatefilename = $oldfilename;
    }

    $stmt = $conn->prepare("UPDATE subcategory SET subname=?, cat_id=?, subimg=? WHERE sub_id=?");

    $stmt->bind_param("sssi", $scatname, $catid, $updatefilename, $scatid);

    if ($stmt->execute()) {
        if (!empty($image)) {
            // If new image is selected, replace the old image
            if (file_exists('../uploads/sub/' . $oldfilename)) {
                unlink('../uploads/sub/' . $oldfilename);
            }
            move_uploaded_file($_FILES['scatimg']['tmp_name'], '../uploads/sub/' . $updatefilename);
        }
        $_SESSION['message'] = "Sub Category Updated Successfully.";
        header("location:view-subcategory.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Sub Category is not updated!";
        header("location:view-subcategory.php");
        exit(0);
    }

    $stmt->close();
}

?>
