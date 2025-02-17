<?php
function get_unique_category(){
if(isset($_GET['category'])){
    global $conn;
    $category_id = $_GET['category'];
    $select_product_by_category = "SELECT * from products where category_id = $category_id";
    $result_product_by_category = mysqli_query($conn,$select_product_by_category);
    $num = mysqli_num_rows($result_product_by_category);
    if($num > 0){
        while ($row = mysqli_fetch_assoc($result_product_by_category)){
            $product_name = $row['product_name'];
            $description = $row['product_description'];
            $price = $row['product_price'];
            $image1 = $row['product_image1'];
            $product_id = $row['product_id'];
            ?>
                                            <div class="col-md-4 mb-2">
                        <div class="card">
      <img class="" src="<?php echo "./admin_area/product_images/$image1"?>" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?php echo($product_name)?></h5>
        <p class="card-text"><?php echo($description)?></p>
        <p class="card-text"><?php echo($price)?></p>     
        <?php
                    $select_product_quantity = "SELECT * from cart where product_id = $product_id ";
                    $result_product_quantity = mysqli_query($conn,$select_product_quantity);
               
                      $exist = mysqli_num_rows($result_product_quantity);
                      if($exist > 0){
                        while ($row = mysqli_fetch_assoc($result_product_quantity)){
                          $quantity = $row['quantity'];
                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
            <input type='number' value='$quantity' class='form-input qty w-50 text-center' name='qty' min='1'>
            <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
          </form>";
                        }
                      } else{
                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
                        <input type='number' value='1' class='form-input qty w-50 text-center' name='qty' min='1'>
                        <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
                      </form>";
                      }
                    
          ?>
                <a href="../../e-commerce project/product_details.php?id=<?php echo($product_id)?>" class="btn btn-secondary mt-2">View more</a>
      </div>
    </div>
                    </div>
            <?php
        }
    } else {
        echo" <h5 class='text-center text-danger mt-5'>No stock for this category</h5>"; 
   }

}
}

function get_unique_brand(){
    if(isset($_GET['brand'])){
        global $conn;
        $brand_id = $_GET['brand'];
        $select_product_by_brand = "SELECT * from products where brand_id = $brand_id";
        $result_product_by_brand = mysqli_query($conn,$select_product_by_brand);

        $num = mysqli_num_rows($result_product_by_brand);
        if($num > 0){
            while ($row = mysqli_fetch_assoc($result_product_by_brand)){
                $product_name = $row['product_name'];
                $description = $row['product_description'];
                $price = $row['product_price'];
                $image1 = $row['product_image1'];
                $product_id = $row['product_id'];
                ?>
                                            <div class="col-md-4 mb-2">
                            <div class="card">
          <img class="" src="<?php echo "./admin_area/product_images/$image1"?>" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><?php echo($product_name)?></h5>
            <p class="card-text"><?php echo($description)?></p>
            <p class="card-text"><?php echo($price)?></p> 
            <?php
                    $select_product_quantity = "SELECT * from cart where product_id = $product_id ";
                    $result_product_quantity = mysqli_query($conn,$select_product_quantity);
               
                      $exist = mysqli_num_rows($result_product_quantity);
                      if($exist > 0){
                        while ($row = mysqli_fetch_assoc($result_product_quantity)){
                          $quantity = $row['quantity'];
                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
            <input type='number' value='$quantity' class='form-input qty w-50 text-center' name='qty' min='1'>
            <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
          </form>";
                        }
                      } else{
                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
                        <input type='number' value='1' class='form-input qty w-50 text-center' name='qty' min='1'>
                        <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
                      </form>";
                      }
                    
          ?>

                <a href="../../e-commerce project/product_details.php?id=<?php echo($product_id)?>" class="btn btn-secondary mt-2">View more</a>
              </div>
            </div>
                            </div>
                             
                    <?php                                                                  
                }
            } else {
                 echo" <h5 class='text-center text-danger'>This brand is not available for service</h5>"; 
            }
    
        }
        }

    function All_products(){
        if(isset($_GET['all_products'])){
            global $conn;
            $page = isset($_GET['page'])  ? $_GET['page'] : 1;
            $limit = 9;
            $start = ($page - 1) * $limit;
            $select_product_by_brand = "SELECT * from products limit $start,$limit";
            $result_product_by_brand = mysqli_query($conn,$select_product_by_brand);

            $select_product_limit = "SELECT * from products";
            $result_product_limit = mysqli_query($conn,$select_product_limit);
            $num_of_rows = mysqli_num_rows($result_product_limit);

            $pages = ceil(($num_of_rows/$limit));
            $next = $page < $pages ? $page + 1 : $page;
            $previous = $page > 1 ? $page - 1 : $page;
            $num = mysqli_num_rows($result_product_by_brand);
            if($num > 0){
                while ($row = mysqli_fetch_assoc($result_product_by_brand)){
                    $product_name = $row['product_name'];
                    $description = $row['product_description'];
                    $price = $row['product_price'];
                    $image1 = $row['product_image1'];
                    $product_id = $row['product_id'];
                    ?>
                                                    <div class="col-md-4 mb-2">
                                <div class="card">
              <img class="" src="<?php echo "./admin_area/product_images/$image1"?>" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?php echo($product_name)?></h5>
                <p class="card-text"><?php echo($description)?></p>
                <p class="card-text"><?php echo($price)?></p>
                <?php
                                    $select_product_quantity = "SELECT * from cart where product_id = $product_id";
                                    $result_product_quantity = mysqli_query($conn,$select_product_quantity);


                                      $exist = mysqli_num_rows($result_product_quantity);
                                      if($exist > 0){
                                        while ($row = mysqli_fetch_assoc($result_product_quantity)){
                                          $quantity = $row['quantity'];
                                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
                            <input type='number' value='$quantity' class='form-input qty w-50 text-center' name='qty' min='1'>
                            <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
                          </form>";
                                        }
                                      } else{
                                        echo "          <form action='./add_to_cart.php?add=$product_id' method='post' class='d-flex w-50'>
                                        <input type='number' value='1' class='form-input qty w-50 text-center' name='qty' min='1'>
                                        <input type='submit' value='Add to cart' class='btn btn-info mx-2' name='add_to_cart'>
                                      </form>";
                                      }
                ?>
                <a href="../../e-commerce project/product_details.php?id=<?php echo($product_id)?>" class="btn btn-secondary mt-2">View more</a>
              </div>
            </div>
                            </div>
                            
                             
                    <?php                                                                  
                }
                
            } else {
                 echo" <h5 class='text-center text-danger'>This brand is not available for service</h5>"; 
            }
            ?>
            <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div></div>
                <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination">
                  <li class="paginate_button page-item previous" id="example2_previous"><a href="../../e-commerce project/index.php?all_products&page=<?php echo($previous)?>" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                  <?php for($i = 1;$i <= $pages;$i++) : ?>
                      <li class="paginate_button page-item "><a href="../../e-commerce project/index.php?all_products&page=<?php echo($i)?>" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link"><?php echo ($i)?></a></li>
                  <?php endfor?>

                  
                  <li class="paginate_button page-item next" id="example2_next"><a href="../../e-commerce project/index.php?all_products&page=<?php echo($next)?>" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
            <?php
        }
        }


    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

    function total_price(){
        $ip = getIPAddress();
        global $conn;
        $total = 0;
        $select_cart = "SELECT * from cart where ip_address = '$ip'";
        $result_cart = mysqli_query($conn,$select_cart);
        while($row = mysqli_fetch_assoc($result_cart)){
          $product_id = $row['product_id'];
          $quantity = $row['quantity'];
          $select_product = "SELECT * from products where product_id = $product_id";
          $result_product = mysqli_query($conn,$select_product);

          while($row = mysqli_fetch_assoc($result_product)){
            $total_price = $row['product_price'] * $quantity;
            $total += $total_price;
          }


        }
        return $total;
    }

?>