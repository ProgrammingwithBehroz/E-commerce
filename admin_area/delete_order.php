<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_order'])){
    $order_id = $_GET['order_id'];
    $delete_order = "DELETE from user_orders where order_id = $order_id";
    $result_delete = mysqli_query($conn,$delete_order);
    if($result_delete){
        echo "<script>alert('order deleted successfully')</script>";
        echo "<script>window.open('./index.php?all-orders','_self')</script>";
    }
}

?>