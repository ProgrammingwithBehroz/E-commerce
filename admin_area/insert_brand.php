<?php
include "../includes/auth_check.php";
?>
<form method="post" class="mt-5">
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" placeholder="Insert brand" name="brand" required autocomplete="off">
</div>
<div class="input-group mb-3">
    <button type="submit" class="btn btn-info mb-3" name="insert_brand">Insert Brand</button>
  </div>
</form>

<?php
if(isset($_POST['insert_brand'])){
    $brand = $_POST['brand'];

    $select_query = "SELECT * from brands where brand_name = '$brand'";
    $result_select = mysqli_query($conn,$select_query);
    $num = mysqli_num_rows($result_select);

    if($num > 0){
        echo "<script>alert('This brand is exist')</script>";
    } else {
        $insert_brand = "INSERT into brands (brand_name) values ('$brand')";
        $result_brand = mysqli_query($conn,$insert_brand);
    
        if($result_brand){
            echo "<script>alert('Brand inserted succcesfully')</script>";
            echo "<script>window.open('./index.php?view_brand','_self')</script>";
        }
    }


}


?>