<?php
if(!isset($_SESSION['useronline'])){
    $_SESSION['errormsg'] = "Session Timed Out, Login";
    header("location:loginpage.php");
    exit();
}
?>