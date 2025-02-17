<?php
include "../includes/auth_check.php";
?>
<h4 class="text-center mt-4">All Brands</h4>
<table class="my-table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th>Brand ID</th>
            <th>Brand Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        $select = "SELECT * from brands";
        $result_select = mysqli_query($conn,$select);
        while($row = mysqli_fetch_assoc($result_select)){
            $name = $row['brand_name'];
            $brand_id = $row['brand_id'];
            $num++;
            ?>
                    <tr class="text-center">
            <td><?php echo($num)?></td>
            <td><?php echo($name)?></td>
            <td><a href="./index.php?edit_brand&brand_id=<?php echo($brand_id)?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="./index.php?delete_brand&brand_id=<?php echo($brand_id)?>" onclick="return confirmation();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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