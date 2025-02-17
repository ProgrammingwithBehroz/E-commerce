<?php
include "../includes/auth_check.php";
?>
<h4 class="text-center mt-4">All Products</h4>
<table class="my-table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody class="text-center">
        <?php
        $select_products = "SELECT * from products";
        $result_products = mysqli_query($conn,$select_products);
        $num = 0;
        while ($row = mysqli_fetch_assoc($result_products)){
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_image = $row['product_image1'];
            $product_price = $row['product_price'];
            $status = $row['status'];
            $num++;
            $total = 0;
            ?>
                  <tr>
                  <td><?php echo($num)?></td>
                  <td><?php echo($product_name)?></td>
                  <td><img src="<?php echo "./product_images/$product_image"?>" alt="" class="product_img"></td>
                  <td><?php echo($product_price)?></td>
                  <?php
                  $select_pending = "SELECT * from pending_orders where product_id = '$product_id'";
                  $result_pending = mysqli_query($conn,$select_pending);
                  while($row = mysqli_fetch_assoc($result_pending)) {
                    $quantity = array($row['quantity']);
                    $total_sold = array_sum($quantity);
                    $total += $total_sold;
                  }

                  ?>
                  <td><?php echo($total)?></td>
                  <td><?php echo($status)?></td>
                  <td><a href="index.php?edit_product&product_id=<?php echo($product_id)?>"><i class="fas fa-edit"></i></a></td>
                  <td id="delete"><a href="index.php?delete_product&product_id=<?php echo($product_id)?>" onclick="return confirmation();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>


                  
            <?php
        }   
        ?>
      </tr>
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">

function confirmation()
{
    var del=confirm("Are you sure you want to delete this record?");
    if (del==true){
}
    return del;
}

</script>