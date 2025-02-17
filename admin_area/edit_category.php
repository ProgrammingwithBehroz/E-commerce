<?php
include "../includes/auth_check.php";

if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $select_category = "SELECT * from categories where category_id = $category_id";
    $result_category = mysqli_query($conn,$select_category);
    $row = mysqli_fetch_assoc($result_category);
    $name = $row['category_name'];
}

?>
<div class="container mt-2">
    <h2 class="text-center">Edit Category</h2>
</div>

<form action="" method="post" class="w-50 m-auto mt-3">
<div class="card-body">
    <div class="form-outline mb-3">
        <input type="text" class="form-control" id="name" name="name" value="<?php echo($name)?>" autocomplete="off" required>
    </div>
</div>
<div class="card-footer mb-3">
    <button type="submit" class="btn btn-info text-light" name="update_category">Update category</button>
</div>
</form>

<?php
if(isset($_POST['update_category'])){
    $category_name = $_POST['name'];
    $update = "UPDATE categories set category_name = '$category_name' where category_id = $category_id";
    $result_update = mysqli_query($conn,$update);

    if($result_update){
        echo "<script>alert('Category updated successfully')</script>";
        echo "<script>window.open('./index.php?view-category','_self')</script>";
    }

}

?>