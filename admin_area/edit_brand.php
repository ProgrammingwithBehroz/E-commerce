<?php
include "../includes/auth_check.php";

if(isset($_GET['brand_id'])){
    $brand_id = $_GET['brand_id'];
    $select_brand = "SELECT * from brands where brand_id = $brand_id";
    $result_brand = mysqli_query($conn,$select_brand);
    $row = mysqli_fetch_assoc($result_brand);
    $name = $row['brand_name'];
}

?>
<div class="container mt-2">
    <h2 class="text-center">Edit Brand</h2>
</div>

<form action="" method="post" class="w-50 m-auto mt-3">
<div class="card-body">
    <div class="form-outline mb-3">
        <input type="text" class="form-control" id="name" name="name" value="<?php echo($name)?>" autocomplete="off" required>
    </div>
</div>
<div class="card-footer mb-3">
    <button type="submit" class="btn btn-info text-light" name="update_brand">Update brand</button>
</div>
</form>

<?php
if(isset($_POST['update_brand'])){
    $brand_name = $_POST['name'];
    $update = "UPDATE brands set brand_name = '$brand_name' where brand_id = $brand_id";
    $result_update = mysqli_query($conn,$update);

    if($result_update){
        echo "<script>alert('Brand updated successfully')</script>";
        echo "<script>window.open('./index.php?view_brand','_self')</script>";
    }

}

?>