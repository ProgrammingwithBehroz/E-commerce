<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include "../connection.php";
include "../functions/common_functions.php";
include "../includes/auth_check_user.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E commerce</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
     integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

      <link href="./checkout.css" rel="stylesheet">
</head>
<body class="body">
    <!-- first child -->
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <img src="../images/logo.jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php?all_products">Products</a>
        </li>
        <?php
        if(isset($_SESSION['username'])){
          ?>
                  <li class="nav-item">
          <a class="nav-link" href="./profile.php">Profile</a>
        </li>
          <?php
        } else {
          ?>
                            <li class="nav-item">
          <a class="nav-link" href="./user_register.php">Register</a>
        </li>
          <?php
        }
        ?>
        <li class="nav-item">
        <?php
          $ip = getIPAddress();
          $select_cart = "SELECT * from cart where ip_address = '$ip'";
          $result_cart = mysqli_query($conn,$select_cart);
          $num = mysqli_num_rows($result_cart);

          ?>
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php echo($num)?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:<?php echo total_price();?>/</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="get" action="./search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="product" aria-label="Search">
        <input type="submit" name="search" value="Search" class="btn btn-outline-light">
      </form>
    </div>
  </div>
</nav>
    </div>   
    <!-- second child -->
    <nav class="navbar navbar-expand-lg nav2">
        <ul class="navbar-nav me-auto">
        <?php
          if(isset($_SESSION['username'])){
            ?>
                      <li class="nav-item">
          <a class="nav-link" href="#">Welcome <?php echo($_SESSION['username'])?></a>
        </li>
            <?php
          } else {
            ?>
                                  <li class="nav-item">
          <a class="nav-link" href="#">Welcome guest</a>
        </li>
            <?php
          }
          ?>
          <?php
          if(isset($_SESSION['username'])){
            ?>
                    <li class="nav-item">
          <a class="nav-link" href="./logout.php">Logout</a>
        </li>
            <?php
          } else {
            ?>
                    <li class="nav-item">
          <a class="nav-link" href="./user_login.php">Login</a>
        </li>
            <?php
          }
          ?>
        </ul>
    </nav>

    <!-- third child -->
     <div class="mt-2">
        <h3 class="text-center">Hidden store</h3>
        <p class="text-center">Communications is the heart of e-commerce and cummunity</p>
     </div>
     <div class="row px-1">
      <div class="col-md-12">
        <div class="row">
            <?php
            if(isset($_SESSION['username'])){
              include "./payment.php";
            } else {
              include "./user_login.php";
            }
            ?>
        </div>
      </div>
     </div>
    
    <!-- last child -->
    <div class="footer">
        <p>All Rights reserved @. Designed  by Behroz Sharifi</p>
    </div>
  <!-- bootsrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>