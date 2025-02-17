<?php
include "../includes/auth_check.php";
if(isset($_GET['delete_payment'])){
    $order_id = $_GET['order_id'];
    $delete_payment = "DELETE from user_payments where order_id = $order_id";
    $result_delete = mysqli_query($conn,$delete_payment);
    if($result_delete){
        echo "<script>alert('Payment deleted successfully')</script>";
        echo "<script>window.open('./index.php?all_payments','_self')</script>";
    }
}

?>