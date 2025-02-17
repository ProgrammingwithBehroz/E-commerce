<?php
session_start();
include "../connection.php";
include "../functions/common_functions.php";
include "../includes/auth_check_user.php";

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_pending = "SELECT * from user_orders where order_id = $order_id";
    $result_select = mysqli_query($conn,$select_pending);
    $row = mysqli_fetch_assoc($result_select);

    $amount = $row['amount_due'];
    $invoice = $row['invoice_num'];
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment Page</title>
        <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link href="./user.css" rel="stylesheet">
</head>
<body class="body">
    <div class="container mt-5 w-50">
        <h3 class="text-center">Confirm Payment</h3>
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control text-center w-50 m-auto"
                 disabled value="<?php echo($invoice)?>" name="invoice">
            </div>
            <div class="form-outline my-4 text-center">
                <label for="amount" class="">Amount</label>
                <input type="text" id="amount" class="form-control text-center w-50 m-auto"
                 disabled value="<?php echo($amount)?>" name="amount">
            </div>
            <div class="form-group">
                        <select class="form-control w-50 m-auto text-center" name="payment_mode">
                          <option>Select Payment Mode</option>
                          <option>UPI</option>
                          <option>Netbanking</option>
                          <option>Paypal</option>
                          <option>Cash on Delivery</option>
                          <option>Pay Offline</option>
                        </select>
                      </div>
                      <div class="form-outline my-4 text-center w-50 m-auto">
                
                    <input type="submit" id="confirm_payment" class="btn"
                     value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript">
$("#confirm_payment").click(function(){
    if(confirm("Are you sure? you wanna pay money?")){
        $("#confirm_payment").attr("href", "logout.php");
    }
    else{
        return false;
    }
});
</script>
    
</body>
</html>

<?php
if(isset($_POST['confirm_payment'])){
    $payment_mode = $_POST['payment_mode'];
    $insert = "INSERT into user_payments (order_id,invoice_num,amount,payment_mode) values
     ($order_id,'$invoice',$amount,'$payment_mode')";
     $result_insert = mysqli_query($conn,$insert);
     if($result_insert){
        $update = "UPDATE user_orders set order_status = 'complete' where order_id = $order_id";
        $result_update = mysqli_query($conn,$update);
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('./profile.php?pending_orders','_self')</script>";
     }



}

?>