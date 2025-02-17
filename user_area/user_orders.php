<?php
session_start();
include "../connection.php";
include "../functions/common_functions.php";
include "../includes/auth_check_user.php";
$user_id = $_SESSION['user_id'];
$invoice = mt_rand();
$amount_due = total_price();
$ip = getIPAddress();
$order_status = "Pending";


$select_product = "SELECT * from cart where ip_address = '$ip'";
$result_product = mysqli_query($conn,$select_product);
$num = mysqli_num_rows($result_product);
if($num > 0 ){
    $insert_order = "INSERT into user_orders (user_id,amount_due,invoice_num,total_products,order_status)
values ($user_id,$amount_due,$invoice,$num,'$order_status')";
$result_order = mysqli_query($conn,$insert_order);

if($result_order){

    $select_cart = "SELECT * from cart where ip_address = '$ip'";
    $result_cart = mysqli_query($conn,$select_cart);
    while($row = mysqli_fetch_assoc($result_cart)){
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
  }
  $insert_pending_orders = "INSERT into pending_orders (user_id,invoice_num,product_id,quantity,order_status) 
  values ($user_id,$invoice,$product_id,$quantity,'$order_status')";
  $result_pending_orders = mysqli_query($conn,$insert_pending_orders);

    $delete_cart = "DELETE from cart where ip_address = '$ip'";
    $result_delete = mysqli_query($conn,$delete_cart);

  echo "<script>alert('Orders are submitted successfully')</script>";
  echo "<script>window.open('./profile.php','_self')</script>";

}

} else {
    echo "<script>alert('No item in cart')</script>";
    echo "<script>window.open('../cart.php','_self')</script>";
}


?>