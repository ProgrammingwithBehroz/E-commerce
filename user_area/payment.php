<?php
  session_start();
include "../includes/auth_check_user.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

      <link href="./checkout.css" rel="stylesheet">
</head>
<body>
            <div class="container">
              <h5 class="text-center">Payment Options</h5>
              <div class="text-center">
    <a href="https://www.paypal.com" target="_blank" class="payment-link">
        <img src="../images/pay.avif" alt="Payment Image" class="payment-img">
    </a>
</div>

<div class="text-center">
    <a href="./user_orders.php" class="pay-btn">Pay Offline</a>
</div>
            
        </div>
     </div>
     </div>
</body>
</html>