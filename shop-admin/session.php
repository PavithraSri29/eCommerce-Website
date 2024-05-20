<?php if (isset($_SESSION['userid'])!='') {
    header("Location: index.php"); 
    exit();
 }
else{
    header("Location: login.php"); 
    exit();
}
?>