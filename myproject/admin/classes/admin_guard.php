<?php
error_reporting(E_ALL);
if(!isset($_SESSION['adminonline'])){
    $_SESSION['admin_errormsg'] = "You need to login";
header("location:loginpage.php");
exit();
}
?>