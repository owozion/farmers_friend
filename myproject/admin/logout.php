<?php
error_reporting(E_ALL);
session_start();

require_once "classes/Myadmin.php";


$user = new Myadmin;
$user->logout();
header("location:loginpage.php");
exit();

?>