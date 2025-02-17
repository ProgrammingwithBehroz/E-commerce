<?php
if(!isset($_SESSION['username']) || $_SESSION['role'] == "admin"){
    echo "<script>window.open('../admin_area/index.php','_self')</script>";
}
?>