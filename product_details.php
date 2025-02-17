<?php
include "./connection.php";
include "./functions/common_functions.php";
session_start();
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

      <link href="./index.css" rel="stylesheet">

</head>
<body class="body">
    <!-- first child -->
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <img src="./images/logo.jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?all_products">Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./user_area/user_register.php">Register</a>
        </li>
        <li class="nav-item">
        <?php
          $ip = getIPAddress();
          $select_cart = "SELECT * from cart where ip_address = '$ip'";
          $result_cart = mysqli_query($conn,$select_cart);
          $num = mysqli_num_rows($result_cart);

          ?>
          <?php
          if(!isset($_SESSION['username']) or $_SESSION['role'] == "user"){
            echo "<a class='nav-link' href='./cart.php'><i class='fa-solid fa-cart-shopping'></i><sup>$num</sup></a>";
          }
          ?>
                   <?php
          if(!isset($_SESSION['username']) or $_SESSION['role'] == "user"){
            ?>
                            <li class='nav-item'>
          <a class='nav-link' href='#'>Total Price:<?php echo total_price();?>/</a>
        </li>
            <?php

          }
          ?>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Total Price:<?php echo total_price();?>/</a>
        </li>
      </ul>
      <div class="hghg">
      <form class="d-flex" role="search" method="get" action="./search_product.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="product" aria-label="Search">
        <input type="submit" name="search" value="Search" class="btn btn-outline-light">
      </form>
      </div>

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
          <a class="nav-link" href="./user_area/logout.php" id="logout">Logout</a>
        </li>
            <?php
          } else {
            ?>
                    <li class="nav-item">
          <a class="nav-link" href="./user_area/user_login.php">Login</a>
        </li>
            <?php
          }
          ?>
        </ul>
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript">
$("#logout").click(function(){
    if(confirm("Are you sure to logout?")){
        $("#logout").attr();
    }
    else{
        return false;
    }
});
</script>

    <!-- third child -->
     <div class="">
     <h3 class="text-center mt-2">Quick Store</h3>
        <p class="text-center">Communications is the heart of e-commerce and cummunity</p>
     </div>
    <!-- fourth child -->
     <div class="row">
        <div class="col-md-10">
            
            <div class="row">
                <!-- cards -->
                <div class="col-md-4">
                    <?php
                    if(isset($_GET['id'])){
                        $product_id = $_GET['id'];

                        $select_product = "SELECT * from products where product_id = $product_id";
                        $result_product = mysqli_query($conn,$select_product);
                        $row = mysqli_fetch_assoc($result_product);
                        $product_name = $row['product_name'];
                        $description = $row['product_description'];
                        $price = $row['product_price'];
                        $image1 = $row['product_image1'];
                        $image2 = $row['product_image2'];
                        $image3 = $row['product_image3'];

                    }
                    ?>
                    <div class="card">
                            <img class="" src="<?php echo "./admin_area/product_images/$image1"?>" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title"><?php echo($product_name)?></h5>
                            <p class="card-text"><?php echo($description)?></p>
                            <p class="card-text"><?php echo($price)?></p>
                            <?php
                    $select_product_quantity = "SELECT * from cart where product_id = $product_id ";
                    $result_product_quantity = mysqli_query($conn,$select_product_quantity);
                    while ($row = mysqli_fetch_assoc($result_product_quantity)){
                      $quantity = $row['quantity'];
                    
          ?>
          <form action="add_to_cart.php?add=<?php echo($product_id)?>" method="post" class="w-50 d-flex">
            <input type="number" value="<?php echo($quantity)?>" class="form-input w-50 mx-2 text-center" name="qty">
            <input type="submit" value="Add to cart" class="btn btn-info" name="add_to_cart">
            <?php }?>
          </form>
                            <a href="./index.php" class="btn btn-secondary mt-2">Go home</a>
                            </div>
                            </div>
                    
                </div>
                <!--product details -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">Related Products</h4>
                        </div>
                        <div class="col-md-6 mt-4">
                            <img src="./admin_area/product_images/<?php echo($image2)?>" alt="" class="card-img-top">
                        </div>
                        <div class="col-md-6 mt-4">
                        <img src="./admin_area/product_images/<?php echo($image3)?>" alt="" class="card-img-top">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 p-0 mb-2 sidebar">
            <!--sidenav -->

            <!-- Brands -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item sidebartitle">
                        <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
                    </li>
                    <?php
                        $select_query = "SELECT * from brands";
                        $result_select = mysqli_query($conn,$select_query);
                        while($row = mysqli_fetch_assoc($result_select)){
                          $brand = $row['brand_name'];
                          $brand_id = $row['brand_id'];
                          ?>
                          <li class="nav-item">
                              <a href="./index.php?brand=<?php echo($brand_id)?>" class="nav-link text-light"><h4><?php echo ($brand)?></h4></a>
                          </li>
                          <?php
                        }
                    ?>

                </ul>

                <!-- Categories -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item sidebartitle">
                        <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
                    </li>
                    <?php
                        $select_query = "SELECT * from categories";
                        $result_select = mysqli_query($conn,$select_query);
                        while($row = mysqli_fetch_assoc($result_select)){
                          $category = $row['category_name'];
                          $category_id = $row['category_id'];
                          ?>
                          <li class="nav-item">
                              <a href="./index.php?category=<?php echo($category_id)?>" class="nav-link text-light"><h4><?php echo ($category)?></h4></a>
                          </li>
                          <?php
                        }
                    ?>
                </ul>
        </div>
     </div>
    
    <!-- last child -->
    <div class="footer">
    <a href="#">All Rights reserved @. Designed  by Behroz Sharifi</a>
    </div>
  <!-- bootsrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>