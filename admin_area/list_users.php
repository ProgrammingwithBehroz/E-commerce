<?php
include "../includes/auth_check.php";
?>
<h4 class="text-center mt-4">List Users</h4>
<table class="my-table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th>SL no</th>
            <th>Username</th>
            <th>User email</th>
            <th>User image</th>
            <th>User address</th>
            <th>User Contact</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
    <?php
$num = 0;
$select_user = "SELECT * from user";
$result_select = mysqli_query($conn,$select_user);
while($row = mysqli_fetch_assoc($result_select)){
$num++;
$user_id = $row['user_id'];
$username = $row['username'];
$email = $row['email'];
$image = $row['image'];
$address = $row['address'];
$contact = $row['contact'];
?>
        <tr>
            <td><?php echo($num)?></td>
            <td><?php echo($username)?></td>
            <td><?php echo($email)?></td>
            <td><?php echo($image)?></td>
            <td><?php echo($address)?></td>
            <td><?php echo($contact)?></td>
            <td><a href="./index.php?delete_user&user_id=<?php echo($user_id)?>" onclick="return confirmation();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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