<?php
include "./functions/common_functions.php";
include "./connection.php";
session_start();
if(isset($_SESSION['role']) and $_SESSION['role'] == "admin"){
    echo "<script>window.open('./admin_area/index.php','_self')</script>";
  }
  
if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['role']) or $_SESSION['role'] == "user"){
    $product_id = $_GET['add'];
    $ip = getIPAddress();
    $quantity = $_POST['qty'];

    $select_product = "SELECT * from cart where product_id = $product_id and ip_address = '$ip'";
    $result_product = mysqli_query($conn,$select_product);
    $num = mysqli_num_rows($result_product);
    $row = mysqli_fetch_assoc($result_product);
    
    if($num > 0){
        $quantity_p = $row['quantity'];
    }
    if($num > 0 && $quantity == $quantity_p){
        echo "<script>alert('This item is already present in cart')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    } elseif ($num > 0 && $quantity != $quantity_p) {
        $update_quantity = "UPDATE cart set quantity = $quantity where product_id = $product_id and ip_address = '$ip'";
        $result_quantity = mysqli_query($conn,$update_quantity);
        echo "<script>alert('This item is already present in cart but you successfully updated the quantity')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    } else {
        $insert_cart = "INSERT into cart (product_id,ip_address,quantity) values ($product_id,'$ip',$quantity)";
        $result_cart = mysqli_query($conn,$insert_cart);

        if($result_cart){
            echo "<script>alert('product succesfully added to cart')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }

    } else {
        
        echo "<script>window.open('./index.php','_self')</script>";
        echo "<script>alert('You don't have allow here')</script>";
    }
}
    
?>