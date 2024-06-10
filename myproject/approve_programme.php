<?php
session_start();
require_once "classes/admin_guard.php";
require_once "classes/Product.php";

   if(isset($_GET['id'])){
         
      $id= $_GET['id'];

       $approve=1;

       $product =new Product;
       $result=$product->update_product_status($approve, $id);

      if($result){
       $_SESSION['feedback']="Approved Successfully";
       header("location:mydashboard.php");
       exit();

      }else{
        $_SESSION['feedback']="Unable to Approve";
        header("location:mydashboard.php");
        exit();
      }



    
   }else{
    header("location:mydashboard.php");
    exit();
   }

?>