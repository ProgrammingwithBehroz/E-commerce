<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_user'])){
    $user_id = $_SESSION['user_id'];
    $delete_user = "DELETE from products where product_id = $user_id";
    $result_delete = mysqli_query($conn,$delete_user);
    if($result_delete){
        echo "<script>alert('User deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_users','_self')</script>";
    }
}

?>