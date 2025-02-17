<?php
include "../connection.php";
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Page</title>
            <!-- bootstrap css link -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link href="../index.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid my-3">
<h3 class="text-center">User Login</h3>
<div class="row d-flex align-item-center justify-content-center">
<div class="lg-12 col-xl-6">
<form method="post">
                <div class="card-body mt-3">
                  <div class="form-outline">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username"
                    required autocomplete="off">
                  </div>
                  <div class="form-outline mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" required name="password"
                    autocomplete="off">
                  </div>
                </div>
                <!-- /.card-body -->
                    <!-- <a href=""><p class="my-3">forgot password</p></a> -->
                <div class="card-footer mt-3">
                  <button type="submit" class="btn btn-info mb-2" name="user_login">Login</button>
                  <p>don't have an account? <span><a href="./user_register.php" class="text-danger">Register</a></span></p>

                </div>
              </form>
</div>

</div>
</div>


</body>
</html>

<?php

if(isset($_POST['user_login'])){

  $username = $_POST['username'];
  $password = sha1($_POST['password']);
  $select_user = "SELECT * from user where username = '$username' and password = '$password'";
  $result_select = mysqli_query($conn,$select_user);
  $row = mysqli_num_rows($result_select);
  if($row > 0){
    $fetch = mysqli_fetch_assoc($result_select);
    $ip = $fetch['user_ip'];
    $user_id = $fetch['user_id'];
    $select_cart = "SELECT * from cart where ip_address = '$ip'";
    $result_cart = mysqli_query($conn,$select_cart);
    $num = mysqli_num_rows($result_cart);
    $role = $fetch['role'];
  }

  if(isset($role) == 'admin' and $num > 0){
    $delete_cart = "DELETE from cart where ip_address = '$ip'";
    $result_delete = mysqli_query($conn,$delete_cart);
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
    echo "<script>alert('Login successfully')</script>";
    echo "<script>window.open('../admin_area/index.php','_self')</script>";
  }



  if($row > 0){
      if($row > 0 and $num > 0){
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        echo "<script>alert('Login successfully')</script>";
        echo "<script>window.open('./payment.php','_self')</script>";
      } elseif ($role == "admin" and $row > 0 and $num == 0) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        echo "<script>alert('Login successfully')</script>";
        echo "<script>window.open('../admin_area/index.php','_self')</script>";
      } elseif ($role == "user" and $row > 0 and $num == 0) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        echo "<script>alert('Login successfully')</script>";
        echo "<script>window.open('./profile.php','_self')</script>";
      }
  } else {
    echo "<script>alert('Invalid credentials')</script>";
  }
}

?>