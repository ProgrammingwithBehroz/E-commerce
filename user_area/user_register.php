<?php
include "../connection.php";
include "../functions/common_functions.php";

?>

<?php

$error_mesages = array();
$username_error = "username must be between 3 and 30";
$address_error = "address must be between 3 and 30";
$fildes_empty_error = "fill all the fields";
$password_do_not_match_error = "passwords don't match";
$username_exist_error = "username or email already exist";

if(isset($_POST['user_register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $password = $_POST['password'];
    $ip = getIPAddress();
    $confirm_pass = $_POST['confirm_pass'];
    $role = "user";

    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $address = htmlspecialchars($address);
    $address = ucfirst(strtolower($address));
    
    $username = htmlspecialchars($username);
    $username = ucfirst(strtolower($username));

    if(strlen($username) <3 || strlen($username) > 30){
      $error_mesages[] = $username_error;
    }

    if(strlen($address) <3 || strlen($address) > 30){
      $error_mesages[] = $address_error;
    }


      $select_user = "SELECT * from user where username = '$username' or email = '$email'";
      $result_select = mysqli_query($conn,$select_user);
      $num = mysqli_num_rows($result_select);
   

    if($num > 0 ){
        $error_mesages[] = $username_exist_error;
    } elseif ($password != $confirm_pass){
        $error_mesages[] = $password_do_not_match_error;
    } elseif (!empty($error_mesages)) {
        $error_mesages[] = $username_error;$address_error;
    } else if(empty($email) || empty($username) || empty($password) || empty($confirm_pass) || empty($address) || 
    empty($contact) || empty($image)){
      $error_mesages[] = $fildes_empty_error;
    } else {
        move_uploaded_file($tmp_image,"./user_images/$image");
        $insert_user = "INSERT into user (username,email,password,image,user_ip,address,contact,role) values ('$username','$email',sha1($password),
        '$image','$ip','$address','$contact','$role')";
        $result_insert = mysqli_query($conn,$insert_user);
    
        if($result_insert){
            echo "<script>alert('User successfully registered')</script>";
            echo "<script>window.open('./checkout.php','_self')</script>";
        }
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register page</title>
        <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link href="../index.css" rel="stylesheet">
     
</head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">User Register</h2>
    <div class="row d-flex align-items-center justify-content-center my-3 mb-2">
        <div class="lg-12 col-xl-6">
        <div class="card-primary">
          <div class="form-group">
          <?php
                  if(in_array($fildes_empty_error,$error_mesages)){
                    echo "<span class='text-danger'>$fildes_empty_error</span>";
                  }
                  ?>
          </div>
          <div class="form-group">
          <?php
                  if(in_array($password_do_not_match_error,$error_mesages)){
                    echo "<span class='text-danger'>$password_do_not_match_error</span>";
                  }
                  ?>
          </div>
          <div class="form-group">
          <?php
                  if(in_array($username_exist_error,$error_mesages)){
                    echo "<span class='text-danger'>$username_exist_error</span>";
                  }
                  ?>
          </div>
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-outline mb-4">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control" id="Username" placeholder="Enter your username"
                     autocomplete="off" name="username" required>
                     <?php
                  if(in_array($username_error,$error_mesages)){
                    echo "<span class='text-danger'>$username_error</span>";
                  }
                  ?>
                  </div>
                  
                  <div class="form-outline mb-4">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email"
                     autocomplete="off" name="email">
                  </div>
                  <div class="form-outline mb-4">
                    <label for="image" class="form-label">User Image</label>
                        <input type="file" class="form-control" id="image" autocomplete="off" name="image">
                  </div>
                  <div class="form-ouline mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password"
                     autocomplete="off" name="password">
                  </div>
                  <div class="form-ouline mb-4">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Confirm Password"
                     autocomplete="off" name="confirm_pass">
                  </div>
                  <div class="form-outline mb-4">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter your address"
                     autocomplete="off" name="address">
                     <?php
                  if(in_array($address_error,$error_mesages)){
                    echo "<span class='text-danger'>$address_error</span>";
                  }
                  ?>
                  </div>
                  <div class="form-outline mb-4">
                    <label for="contact">Contact</label>
                    <input type="number" class="form-control" id="contact" placeholder="Enter your contact"
                     autocomplete="off" name="contact">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info my-2" name="user_register">Register</button>
                  <p>have an account? <span><a href="./user_login.php" class="text-danger">Login</a></span></p>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>



