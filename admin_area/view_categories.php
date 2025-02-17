<?php
include "../includes/auth_check.php";
?>
<h4 class="text-center mt-4">All Categories</h4>
<table class="my-table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        $select = "SELECT * from categories";
        $result_select = mysqli_query($conn,$select);
        while($row = mysqli_fetch_assoc($result_select)){
            $name = $row['category_name'];
            $category_id = $row['category_id'];
            $num++;
            ?>
                    <tr class="text-center">
            <td><?php echo($num)?></td>
            <td><?php echo($name)?></td>
            <td><a href="./index.php?edit_category&category_id=<?php echo($category_id)?>"><i class="fas fa-edit"></i></a></td>
            <td><a href="./index.php?delete_category&category_id=<?php echo($category_id)?>" onclick="return confirmation();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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