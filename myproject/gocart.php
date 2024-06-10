<?php
session_start();
error_reporting(E_ALL);
require_once "user_guard.php";


    unset($_SESSION["refno"]);
    header("location:showcart.php");
    exit();

?>
