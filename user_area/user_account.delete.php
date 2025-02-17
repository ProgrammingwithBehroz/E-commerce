<?php
include "../includes/auth_check_user.php";

if(isset($_POST['delete_account'])){
    $user_id = $_SESSION['user_id'];
    $delete = "DELETE from user where user_id = $user_id";
    $result = mysqli_query($conn,$delete);

    if($result){
        session_destroy();
        echo "<script>alert('Successfully deleted the account')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete_account'])){
    echo "<script>window.open('./profile.php','_self')</script>";
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account page</title>
        <!-- bootstrap css link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link href="../index.css" rel="stylesheet">

</head>
<body>
    <h4 class="text-center text-danger mt-5">Delete Account</h4>
    <form action="" method="post">
        <div class="form-outline w-50 m-auto mt-5">
            <input type="submit" name="delete_account" id="delete_account" class="form-control" value="Delete Account">
        </div>
        <div class="form-outline w-50 m-auto mt-5">
            <input type="submit" name="dont_delete_account" class="form-control" value="Don't Delete Account">
        </div>
    </form>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
              <script type="text/javascript">
$("#delete_account").click(function(){
    if(confirm("Are you sure you want to delete your account?")){
        $("#delete_account").attr("href", "logout.php");
    }
    else{
        return false;
    }
});
</script>

