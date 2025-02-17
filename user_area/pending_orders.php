<?php
include "../includes/auth_check_user.php";
?>
<h4 class="text-center">All My Orders</h4>

                <table class="my-table table-bordered mt-2">
                  <thead>
                    <tr class="text-center">
                      <th class="">SL no</th>
                      <th class="">Order Number</th>
                      <th class="">Amount Due</th>
                      <th class="">Total Products</th>
                      <th class="">Invoice Number</th>
                      <th class="">Date</th>
                      <th class="">Complete/Incomplete</th>
                      <th class="">Status</th>
                      

                    </tr>
                  </thead>
                  <tbody class="text-center">
                    
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $num = 0;
                        $select_pending = "SELECT * from user_orders where user_id = $user_id";
                        $result_select = mysqli_query($conn,$select_pending);
                        while($row = mysqli_fetch_assoc($result_select)){
                            $num++;
                            $order_num = $row['order_id'];
                            $amount = $row['amount_due'];
                            $total_products = $row['total_products'];
                            $invoice = $row['invoice_num'];
                            $date = $row['order_date'];
                            $status = $row['order_status'];
                            $order_id = $row['order_id'];
                             if($status == "Pending"){
                              $status = "incomplete";
                             } else {
                              $status = "complete";
                             }
                            ?>
                            <tr>
                            <td><?php echo($num)?></td>
                            <td><?php echo($order_num)?></td>
                            <td><?php echo($amount)?></td>
                            <td><?php echo($total_products)?></td>
                            <td><?php echo($invoice)?></td>
                            <td><?php echo($date)?></td>
                            <td><?php echo($status)?></td>
                            <?php
                              if($status == 'complete'){
                                ?>
                                <td>paid</td>
                                <?php
                              } else {
                                ?>
                                <td><a href="./confirm_payment.php?order_id=<?php echo($order_id)?>">confirm</a></td>
                                <?php
                              }
                            ?>
                            
                            <?php
                        }
                        ?>
                    </tr>
                  </tbody>
                </table>


        