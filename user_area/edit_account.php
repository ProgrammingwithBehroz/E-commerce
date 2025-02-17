<?php
include "../includes/auth_check_user.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        .image{
            width: 10%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="text-center text-success">Edit Account</h4>
    </div>

    <div class="card card-primary w-50 m-auto">
              <!-- form start -->
               <?php
               $user_id = $_SESSION['user_id'];

               $select_user = "SELECT * from user where user_id = $user_id";
               $result_user = mysqli_query($conn,$select_user);
               $row = mysqli_fetch_assoc($result_user);
               $username = $row['username'];
               $email = $row['email'];
               $image = $row['image'];
               $address = $row['address'];
               $contact = $row['contact'];
               
               ?>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-outline mb-4">
                   
                    <input type="text" class="form-control" id="Username" value="<?php echo($username)?>"
                     autocomplete="off" name="username" required>
                  </div>
                  <div class="form-outline mb-4">
                     
                    <input type="email" class="form-control" id="email" value="<?php echo($email)?>"
                     autocomplete="off" name="email" required>
                  </div>
                  <div class="form-outline mb-4 d-flex">
                        <input type="file" class="form-control" id="image" value="<?php echo($image)?>" autocomplete="off"
                         name="image">
                         <img src="./user_images/<?php echo($image)?>" alt="" class="image">
                         
                  </div>
                  <div class="form-outline mb-4">
              
                    <input type="text" class="form-control" id="address"
                     autocomplete="off" value="<?php echo($address)?>" name="address" required>
                  </div>
                  <div class="form-outline mb-4">
                   
                    <input type="text" class="form-control" id="contact"
                     autocomplete="off" value="<?php echo($contact)?>" name="contact" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-info my-2" name="user_update" id="user_update">Update</button>
                </div>
              </form>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript">
$("#user_update").click(function(){
    if(confirm("Are you sure for update?")){
        $("#user_update").attr("href", "logout.php");
    }
    else{
        return false;
    }
});
</script>

</body>
</html>

<?php

if(isset($_POST['user_update'])){
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $ip = getIPAddress();
    $address = $_POST['address'];
    $contact = $_POST['contact'];
   $target = "uploads/".basename($image);
    $select_user = "SELECT * from user where (username = '$username' or email = '$email') and user_id != $user_id";
    $result_select = mysqli_query($conn,$select_user);
    $num = mysqli_num_rows($result_select);
    $row = mysqli_fetch_assoc($result_select);
    

    if($num > 0){
        echo "<script>alert('username or email already exist')</script>";
    } else {

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
      {
        $msg = "Image uploaded successfully";
      }  else
         {
           $msg = "Failed to upload image";
         }
     }
     if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"] != "") {
      move_uploaded_file($tmp_image,"./user_images/$image");
      $update_user = "UPDATE user set username = '$username', email = '$email', image = '$image',
      address = '$address', contact = '$contact' where user_id = $user_id";
      $result_update = mysqli_query($conn,$update_user);

      if($result_update){
          echo "<script>alert('Data updated successfully')</script>";
          echo "<script>window.open('./logout.php','_self')</script>";
      }
      }else{
        $update_user = "UPDATE user set username = '$username', email = '$email',
        address = '$address', contact = '$contact' where user_id = $user_id";
        $result_update = mysqli_query($conn,$update_user);
  
        if($result_update){
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('./logout.php','_self')</script>";
        }
      
      }

    }




?>