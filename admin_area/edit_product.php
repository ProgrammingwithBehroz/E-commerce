<?php
include "../includes/auth_check.php";

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $select_product = "SELECT * from products where product_id = $product_id";
    $result_select = mysqli_query($conn,$select_product);
    $row = mysqli_fetch_assoc($result_select);
        $product_name = $row['product_name'];
        $description = $row['product_description'];
        $image1p = $row['product_image1'];
        $image2p = $row['product_image2'];
        $image3p = $row['product_image3'];
        $price = $row['product_price'];
        $category_idp = $row['category_id'];
        $brand_idp = $row['brand_id'];

        $select_category = "SELECT * from categories where category_id = $category_idp";
        $result_category = mysqli_query($conn,$select_category);
        $row = mysqli_fetch_assoc($result_category);
            $category_name = $row['category_name'];

    $select_brand = "SELECT * from brands where brand_id = $brand_idp";
    $result_brand = mysqli_query($conn,$select_brand);
    $row = mysqli_fetch_assoc($result_brand);
    $brand_name = $row['brand_name'];
}



?>

<div class="container">
    <h2 class="text-center">Edit Product</h2>
</div>

<form class="w-50 m-auto" method="post" enctype="multipart/form-data">
<div class="card-body">
                  <div class="form-outline mb-3">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo($product_name)?>" autocomplete="off" required>
                  </div>
                  <div class="form-outline mb-3">
                    <input type="text" class="form-control" id="Description" value="<?php echo($description)?>" name="description" autocomplete="off" required>
                  </div>
                  <div class="form-outline mb-3">

                        <select class="custom-select" required name="category">
                        <option value="<?php echo($category_idp)?>"><?php echo($category_name)?></option>
                        <?php
                                $select_category = "SELECT * from categories";
                                $result_category = mysqli_query($conn,$select_category);
                                while($row = mysqli_fetch_assoc($result_category)){
                                    $category_names = $row['category_name'];
                                    $category_id = $row['category_id']
                                    ?>
                                        <option value="<?php echo($category_id)?>"><?php echo($category_names)?></option>
                                    <?php
                                }
                            ?>
                        </select>
                      </div>
                      <div class="form-outline mb-3">
                        <select class="custom-select" required name="brand">
                        <option value="<?php echo($brand_idp)?>"><?php echo($brand_name)?></option>
                        <?php
                                $select_brand = "SELECT * from brands";
                                $result_brand = mysqli_query($conn,$select_brand);
                                while($row = mysqli_fetch_assoc($result_brand)){
                                    $brand_names = $row['brand_name'];
                                    $brand_id = $row['brand_id']
                                    ?>
                                        <option value="<?php echo($brand_id)?>"><?php echo($brand_names)?></option>
                                    <?php
                                }
                            ?>
                        </select>
                      </div>
                      
                      <div class="mb-3 form-outline d-flex ">
                       
                        <input class="form-control" type="file" id="image1" name="image1">
                        <img src="./product_images/<?php echo($image1p)?>" alt=""  class="product_img">
                      </div>

                      <div class="mb-3 form-outline d-flex">
                        
                        <input class="form-control" type="file" id="image2" name="image2">
                        <img src="./product_images/<?php echo($image2p)?>" alt="" class="product_img">
                      </div>
                      <div class="mb-3 form-outline d-flex">
                  
                        <input class="form-control" type="file" id="image3" name="image3">
                        <img src="./product_images/<?php echo($image3p)?>" alt="" class="product_img">
                      </div>
                      <div class="form-outline mb-3">
                   
                    <input type="text" class="form-control" id="name" name="price" placeholder="Enter product name"
                     autocomplete="off" required value="<?php echo($price)?>">
                  </div>
</div>

<div class="card-footer mb-3">
                  <button type="submit" class="btn btn-info text-light" name="update_product">Update product</button>
                </div>
</form>

<?php

if(isset($_POST['update_product'])){
    $product_name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
  


    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    $tmp_image1 = $_FILES['image1']['tmp_name'];
    $tmp_image2 = $_FILES['image2']['tmp_name'];
    $tmp_image3 = $_FILES['image3']['tmp_name'];

    if($image1 == ""){
      $image1 = $image1p;
    }
    
    if($image2 == ""){
      $image2 = $image2p;
    }

    if($image3 == ""){
      $image3 = $image3p;
    }
        move_uploaded_file($tmp_image1,"product_images/$image1");
        move_uploaded_file($tmp_image2,"product_images/$image2");
        move_uploaded_file($tmp_image3,"product_images/$image3");

        $update_product = "UPDATE products set product_name = '$product_name', product_description = '$description', category_id
        = '$category', brand_id = '$brand',product_image1 = '$image1',product_image2 = '$image2',product_image3 = '$image3',
        product_price = $price where product_id = $product_id";
        $result_update = mysqli_query($conn,$update_product);
        if($result_update){
           echo "<script>alert('Product updated successfully')</script>";
           echo "<script>window.open('./index.php?view_products','_self')</script>";
        }
     
}

?>