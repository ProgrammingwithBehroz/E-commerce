<?php
include "../includes/auth_check.php";
?>
<h4 class="text-center mt-4">All Payments</h4>
<table class="my-table table-bordered mt-4">
    <thead>
        <tr class="text-center">
            <th>SL no</th>
            <th>Amount Due</th>
            <th>Invoice Num</th>
            <th>Payment Mode</th>
            <th>Order Date</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
    <?php
$num = 0;
$select_payments = "SELECT * from user_payments";
$result_select = mysqli_query($conn,$select_payments);
while($row = mysqli_fetch_assoc($result_select)){
$num++;
$amount = $row['amount'];
$invoice = $row['invoice_num'];
$date = $row['date'];
$order_id = $row['order_id'];
$payment_mode = $row['payment_mode'];
?>
        <tr>
            <td><?php echo($num)?></td>
            <td><?php echo($amount)?></td>
            <td><?php echo($invoice)?></td>
            <td><?php echo($payment_mode)?></td>
            <td><?php echo($date)?></td>
            <td><a href="./index.php?delete_payment&order_id=<?php echo($order_id)?>" onclick="return confirmation();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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