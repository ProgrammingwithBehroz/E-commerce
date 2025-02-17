<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_product'])){
    $product_id = $_GET['product_id'];
    $delete_product = "DELETE from products where product_id = $product_id";
    $result_delete = mysqli_query($conn,$delete_product);
    if($result_delete){
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}

?>