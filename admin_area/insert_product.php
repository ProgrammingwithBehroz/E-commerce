<?php
include "../connection.php";
include "../includes/auth_check.php";

if(isset($_POST['insert_product'])){

  $product_name = $_POST['name'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $brand = $_POST['brand'];
  $price = $_POST['price'];
  $status = 'true';

  $image1 = $_FILES['image1']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];

  // temporary name
  $image1_tmp = $_FILES['image1']['tmp_name'];
  $image2_tmp = $_FILES['image2']['tmp_name'];
  $image3_tmp = $_FILES['image3']['tmp_name'];

  move_uploaded_file($image1_tmp,"product_images/$image1");
  move_uploaded_file($image2_tmp,"product_images/$image2");
  move_uploaded_file($image3_tmp,"product_images/$image3");

  $insert_product = "INSERT into products (product_name,product_description,category_id,brand_id,product_image1,
  product_image2,product_image3,product_price,status) values ('$product_name','$description',$category,$brand,'$image1','$image2',
  '$image3',$price,'$status')";
  $result_product = mysqli_query($conn,$insert_product);

  if($result_product){
    echo "<script>alert('Product inserted succcesfully')</script>";
    echo "<script>window.open('./index.php?view_products','_self')</script>";
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin-Dashboard</title>
            <!-- bootstrap css link -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <link href="../index.css" rel="stylesheet">

</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Insert Product</h3>
    </div>
<form class="w-50 m-auto" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-outline mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" autocomplete="off" required>
                  </div>
                  <div class="form-outline mb-3">
                    <label for="Description" class="form-label">Product Description</label>
                    <input type="text" class="form-control" id="Description" name="description" placeholder="Enter product description" autocomplete="off" required>
                  </div>
                  <div class="form-outline mb-3">
                        <label></label>
                        <select class="custom-select" required name="category">
                          <option>Select a category</option>
                          <?php
                                $select_category = "SELECT * from categories";
                                $result_category = mysqli_query($conn,$select_category);
                                while($row = mysqli_fetch_assoc($result_category)){
                                    $category_name = $row['category_name'];
                                    $category_id = $row['category_id']
                                    ?>
                                        <option value="<?php echo($category_id)?>"><?php echo($category_name)?></option>
                                    <?php
                                }
                            ?>
                          
                        </select>
                      </div>
                      <div class="form-outline mb-3">
                        <label></label>
                        <select class="custom-select" required name="brand">
                          <option>Select a brand</option>
                          <?php
                                $select_brand = "SELECT * from brands";
                                $result_brand = mysqli_query($conn,$select_brand);
                                while($row = mysqli_fetch_assoc($result_brand)){
                                    $brand_name = $row['brand_name'];
                                    $brand_id = $row['brand_id']
                                    ?>
                                        <option value="<?php echo($brand_id)?>"><?php echo($brand_name)?></option>
                                    <?php
                                }
                            ?>
                        </select>
                      </div>
                      <div class="mb-3 form-outline">
                        <label for="formFile" class="form-label">Product Image 1</label>
                        <input class="form-control" type="file" id="formFile" name="image1" required>
                      </div>
                      <div class="mb-3 form-outline">
                        <label for="formFile" class="form-label">Product Image 2</label>
                        <input class="form-control" type="file" id="formFile" name="image2">
                      </div>
                      <div class="mb-3 form-outline">
                        <label for="formFile" class="form-label">Product Image 3</label>
                        <input class="form-control" type="file" id="formFile" name="image3">
                      </div>
                      <div class="form-outline mb-3">
                    <label for="name" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="name" name="price" placeholder="Enter product name" autocomplete="off" required>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer mb-3">
                  <button type="submit" class="btn btn-primary" name="insert_product">Insert product</button>
                </div>
              </form>
</body>
</html>
