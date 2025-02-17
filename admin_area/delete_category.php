<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_category'])){
    $category_id = $_GET['category_id'];
    $delete_category = "DELETE from categories where category_id = $category_id";
    $result_delete = mysqli_query($conn,$delete_category);
    if($result_delete){
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('./index.php?view-category','_self')</script>";
    }
}

?>