<?php
error_reporting(E_ALL);
session_start();

require_once "classes/Farmer.php";
require_once "classes/Customer.php";
require_once "classes/Ngo.php";
require_once "classes/Government.php";

$user = new Farmer;
$user = new Customer;
$user = new Government;
$user = new Ngo;
$user->logout();
header("location:loginpage.php");
exit();

?>