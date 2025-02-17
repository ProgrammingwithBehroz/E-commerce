<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_brand'])){
    $brand_id = $_GET['brand_id'];
    $delete_brand = "DELETE from brands where brand_id = $brand_id";
    $result_delete = mysqli_query($conn,$delete_brand);
    if($result_delete){
        echo "<script>alert('Brand deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_brand','_self')</script>";
    }
}

?>