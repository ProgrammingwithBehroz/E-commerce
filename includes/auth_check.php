<?php
@session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] === 'user'){
    echo "<script>window.open('../user_area/user_login.php','_self')</script>";
    exit();
}
?>