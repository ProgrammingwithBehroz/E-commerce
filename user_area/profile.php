<?php
session_start();
include "../connection.php";
include "../functions/common_functions.php";
include "../includes/auth_check_user.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo($_SESSION['username'])?></title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
     integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

      <link href="./user.css" rel="stylesheet">

      <style>
        .user_image{
            width: 50%;
            margin: auto;
            display: block;
            object-fit: contain;
            border-radius: 5px;
        }
      </style> 

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
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php?all_products">Products</a>
        </li>
        <?php
        if(isset($_SESSION['username'])){
          ?>
                  <li class="nav-item">
          <a class="nav-link active" href="./profile.php">Profile</a>
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
      <div class="hghg">
      <form class="d-flex" role="search" method="get" action="../search_product.php">
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
          <a class="nav-link" href="./logout.php" id="logout2">Logout</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
$("#logout2").click(function(){
    if(confirm("Are you sure to logout?")){
        $("#logout2").attr();
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

     <div class="row my-2">
        <div class="col-md-2 sidebar side2">
            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a href="#" class="nav-link text-light sidebartitle"><h4>Your Profile</h4></a>
                </li>
                <li class="nav-item">
                    <?php
                    $username = $_SESSION['username'];
                    $select_user_image = "SELECT * from user where username = '$username'";
                    $result_user_image = mysqli_query($conn,$select_user_image);
                    $row = mysqli_fetch_assoc($result_user_image);
                    $image = $row['image'];
                    ?>
                    <img src="./user_images/<?php echo($image)?>" alt="" class="user_image my-2">
                </li>
                <li class="nav-item ">
                <a href="profile.php" class="nav-link text-light <?php if(!isset($_GET['edit_account']) && !isset($_GET['pending_orders']) && !isset($_GET['delete_account'])){echo "active";}?>"><h4>Pending orders</h4></a>
                </li>
                <li class="nav-item">
                <a href="./profile.php?edit_account" class="nav-link text-light <?php if(isset($_GET['edit_account'])){echo "active";}?>"><h4>Edit account</h4></a>
                </li>
                <li class="nav-item">
                <a href="./profile.php?pending_orders" class="nav-link text-light <?php if(isset($_GET['pending_orders'])){echo "active";}?>"><h4>My orders</h4></a>
                </li>
                <li class="nav-item">
                <a href="./profile.php?delete_account" class="nav-link text-light <?php if(isset($_GET['delete_account'])){echo "active";}?>"><h4>Delete account</h4></a>
                </li>
                <li class="nav-item">
                <a href="./logout.php" class="nav-link text-light" id="logout"><h4>Logout</h4></a>
                </li>
            </ul>
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
        </div>
        <div class="col-md-10">
          <?php
          $user_id = $_SESSION['user_id'];
          $select_orders = "SELECT * from user_orders where user_id = $user_id";
          $result_orders = mysqli_query($conn,$select_orders);
          $num = mysqli_num_rows($result_orders);

          if($num > 0){
            if(!isset($_GET['edit_account'])){
                if(!isset($_GET['order'])){
                    if(!isset($_GET['delete_account'])){
                      if(!isset($_GET['pending_orders'])){
                        
                      
                        ?>
                        <h2 class="text-success text-center mt-5">You have <span class="text-danger"><?php echo($num)?></span> pending orders</h2>
                        <p class="text-center mt-4"><a href="profile.php?pending_orders">Order details</a></p>
                        <?php
                      } 
                    }
                    }
                  }
                    } else {
                      ?>
                      <h2 class="text-success text-center mt-5">You have <span class="text-danger">0</span> pending orders</h2>
                      <p class="text-center mt-4"><a href="profile.php?pending_orders">Order details</a></p>
                      <?php
                    }
          ?>
          <?php
          if(isset($_GET['edit_account'])){
            include "./edit_account.php";
          }

          if(isset($_GET['pending_orders'])){
            include "pending_orders.php";
          }

          if(isset($_GET['delete_account'])){
            include "./user_account.delete.php";
          }
          ?>
          
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