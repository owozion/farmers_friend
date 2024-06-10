<?php
require_once "classes/Product.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
     // echo $_GET["id"];

        $del1 = new Product;
        $response = $del1-> delete_product($id);

        if($response){
            $_SESSION['feedback'] = 'Deleted successfully!';
        header("location:dashboard.php"); exit();
            //keep it inside session
            //redirect them back to dashboard.php and display the message.
            // echo "Deleted successfully";

        }else{
            echo "Unable to delete";
        }
    }
?>