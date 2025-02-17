<?php
session_start();
include "./connection.php";
include "./functions/common_functions.php";
if(isset($_SESSION['role']) and $_SESSION['role'] == "admin"){
  echo "<script>window.open('./admin_area/index.php','_self')</script>";
}

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

      <style>
        .product_img{
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
      </style>

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
        <?php
        if(isset($_SESSION['username'])){
          if($_SESSION['role'] == "user"){
            ?>
            <li class="nav-item">
    <a class="nav-link" href="./user_area/profile.php">Profile</a>
  </li>
    <?php
          } elseif ($_SESSION['role'] == "admin") {
            ?>
            <li class="nav-item">
    <a class="nav-link" href="./admin_area/index.php">Profile</a>
  </li>
    <?php
          }
        } else {
          ?>
                            <li class="nav-item">
          <a class="nav-link" href="./user_area/user_register.php">Register</a>
        </li>
          <?php
        }
        ?>
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
     <h3 class="text-center">Quick Store</h3>
        <p class="text-center">Communications is the heart of e-commerce and cummunity</p>
     </div>
         
     <!-- fourth child -->
      <div class="container">
        <div class="row">
            <form action="" method="post">
        <table class="my-table table-bordered text-center">

  <tbody>
    <?php
    $ip = getIPAddress();
    $select_cart = "SELECT * from cart where ip_address = '$ip'";
    $result_cart = mysqli_query($conn,$select_cart);
    $num = 0;
    $total = 0;
    $num = mysqli_num_rows($result_cart);
    if($num > 0){
      echo "  <thead>
    <tr>
      <th scope='col'>Sl</th>
      <th scope='col'>Product Name</th>
      <th scope='col'>Product Image</th>
      <th>Quantity</th>
      <th scope='col'>Total Price</th>
      <th scope='col'>Remove</th>
      
    </tr>
  </thead>";
    } else {
      echo "<h5 class='text-center text-danger mt-5'>No item in cart</h5>";
    }
      
    

    while($row = mysqli_fetch_assoc($result_cart)){
      $product_id = $row['product_id'];
      $quantity = $row['quantity'];
      $select_product = "SELECT * from products where product_id = $product_id";
      $result_product = mysqli_query($conn,$select_product);
      while($row = mysqli_fetch_assoc($result_product)){
        $product_name = $row['product_name'];
        
        $product_image = $row['product_image1'];
        $price = $row['product_price'] * $quantity;
        $total += $price; 
        $num++;
        ?>
            <tr>
      <td><?php echo($num)?></td>
      <td><?php echo($product_name)?></td>
      <td><img src="./admin_area/product_images/<?php echo($product_image)?>" class="product_img" alt=""></td>
      <td><?php echo($quantity)?></td>
      <td><?php echo($price)?></td>
      <td><input type="checkbox" value="<?php echo($product_id)?>" name="removeitem[]"></td>
      <?php
      if(isset($_POST['remove_cart'])){
        if(isset($_POST['removeitem'])){
          foreach($_POST['removeitem'] as $remove){
          
            $delete_cart = "DELETE from cart where product_id = $remove";
            $result_delete = mysqli_query($conn,$delete_cart);
              if($result_delete){
                echo "<script>window.open('./cart.php','_self')</script>";
              }
          }
        }  else {
          echo "<script>alert('There is no item to delete')</script>";
        } 
      }
      ?>
      
      
    </tr>
        <?php
      }
    }
  
    ?>
    
  </tbody>
  
</table>
<?php
                if($num > 0){
                  ?>
                  <td><input type="submit" value="Remove Cart" class="bg-danger px-3 py-2 border-0 mx-3 text-light btn mt-2" name="remove_cart" id="remove_cart"></td>
                  <?php
                }
                ?>

</form>
            <div class="d-flex mb-3">
                <h4 class="px-3">SubTotal: <strong class="text-info"><?php echo ($total)?>/-</strong></h4>
                <a href="./index.php"><button class="btn btn-info mx-3 px-3">Continue Shopping</button></a>
                <?php
                if($num > 0){
                  echo "<a href='./user_area/checkout.php'><button class='btn btn-secondary px-3'>Checkout</button></a>";
                }
                ?>
                
            </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript">
$("#remove_cart").click(function(){
    if(confirm("Are you sure?")){
        $("#remove_cart").attr();
    }
    else{
        return false;
    }
});
</script>