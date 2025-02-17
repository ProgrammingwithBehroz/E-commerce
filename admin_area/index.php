<?php
session_start();
include "../connection.php";
include "../includes/auth_check.php";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

        <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

         <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
     integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="./admin.css" rel="stylesheet">
</head>
<body class="body">

    <!-- first child -->
     <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <img src="../images/logo.jpg" class="logo" alt="">
                        <?php
                        if(isset($_SESSION['username'])){
                            ?>
                                  <li>
                            <a href="">Welcome <?php echo $_SESSION['username']?></a>
                        </li>
                            <?php
                        } else {
                            ?>
                                   <li>
                            <a href="">Welcome guest</a>
                        </li>
                            <?php
                        }
                        ?>
            </div>
        </nav>
             <!-- second child -->
     <div class="p-2 mt-2">
        <h4 class="text-center ">Manage Details</h4>
     </div>

     <!-- third child -->
      <div class="row">
        <div class="col-md-12 p-1 d-flex align-items-center">
            <div class="px-5">
            <?php
                    $username = $_SESSION['username'];
                    $select_user_image = "SELECT * from user where username = '$username'";
                    $result_user_image = mysqli_query($conn,$select_user_image);
                    $row = mysqli_fetch_assoc($result_user_image);
                    $image = $row['image'];
                    ?>
                <a href="#"><img src="<?php echo "../user_area/user_images/$image"?>" alt="" class="admin-product-img "></a>
                <p class="text-center"><?php echo $_SESSION['username']?></p>
            </div>
            <div class="button text-center">
                <button class="btn mt-2"><a href="./insert_product.php" class="nav-link text-light my-1 p-2">Insert Products</a></button>
                <button class="btn mt-2"><a href="./index.php?view_products" class="nav-link text-light my-1 p-2">View Products</a></button>
                <button class="btn mt-2"><a href="./index.php?insert_category" class="nav-link text-light my-1 p-2">Insert Categories</a></button>
                <button class="btn mt-2"><a href="./index.php?view-category" class="nav-link text-light  my-1 p-2">View Categories</a></button>
                <button class="btn mt-2"><a href="./index.php?insert_brand" class="nav-link text-light my-1 p-2">Insert Brands</a></button>
                <button class="btn mt-2"><a href="./index.php?view_brand" class="nav-link text-light my-1 p-2">View Brands</a></button>
                <button class="btn mt-2"><a href="./index.php?all-orders" class="nav-link text-light my-1 p-2">All Orders</a></button>
                <button class="btn mt-2"><a href="./index.php?all_payments" class="nav-link text-light my-1 p-2">All Payments</a></button>
                <button class="btn mt-2"><a href="./index.php?list_users" class="nav-link text-light my-1 p-2">List Users</a></button>
                <button class="btn mt-2"><a href="../user_area/logout.php" class="nav-link text-light my-1 p-2" id="logout">Logout</a></button>
            </div>
        </div>
      </div>

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

      <!-- fourth child -->
       <div class="container">
        <?php
        if(isset($_GET['insert_category'])){
            include "./insert_category.php";
        }
        if(isset($_GET['insert_brand'])){
            include "./insert_brand.php";
        }
        if(isset($_GET['view_products'])){
            include "./view_products.php";
        }
        if(isset($_GET['edit_product'])){
            include "./edit_product.php";
        }
        if(isset($_GET['delete_product'])){
            include "./delete_product.php";
        }
        if(isset($_GET['view-category'])){
            include "./view_categories.php";
        }
        if(isset($_GET['view_brand'])){
            include "./view_brands.php";
        }
        if(isset($_GET['edit_category'])){
            include "./edit_category.php";
        }
        if(isset($_GET['delete_category'])){
            include "./delete_category.php";
        }
        if(isset($_GET['delete_brand'])){
            include "./delete_brand.php";
        }
        if(isset($_GET['edit_brand'])){
            include "./edit_brand.php";
        }
        if(isset($_GET['all-orders'])){
            include "./all_orders.php";
        }
        if(isset($_GET['delete_order'])){
            include "./delete_order.php";
        }
        if(isset($_GET['all_payments'])){
            include "./all_payments.php";
        }
        if(isset($_GET['list_users'])){
            include "./list_users.php";
        }
        ?>
       </div>
          <!-- last child -->
    <div class="footer mt-2">
        <a href="#">All Rights reserved @. Designed  by Behroz Sharifi</a>
    </div>

     </div>



    <!-- bootsrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>