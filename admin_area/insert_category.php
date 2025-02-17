<?php
include "../includes/auth_check.php";
?>
<form method="post" class="mt-5">
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" placeholder="Insert category" name="category" required autocomplete="off">
</div>
<div class="input-group mb-3">
    <button type="submit" class="btn btn-info mb-3" name="insert_category">Insert Category</button>
  </div>
</form>

<?php
if(isset($_POST['insert_category'])){
    $category = $_POST['category'];

    $select_query = "SELECT * from categories where category_name = '$category'";
    $result_select = mysqli_query($conn,$select_query);
    $num = mysqli_num_rows($result_select);

    if($num > 0){
        echo "<script>alert('This category is exist')</script>";
    } else {
        $insert_brand = "INSERT into categories (category_name) values ('$category')";
        $result_brand = mysqli_query($conn,$insert_brand);
    
        if($result_brand){
            echo "<script>alert('category inserted succcesfully')</script>";
            echo "<script>window.open('./index.php?view-category','_self')</script>";
        }
    }


}


?>