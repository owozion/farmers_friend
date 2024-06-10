<?php
require_once "classes/Power.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
     // echo $_GET["id"];

        $del1 = new Power;
        $response = $del1-> delete_ngo($id);

        if($response){
            $_SESSION['useronline'] = 'Deleted successfully!';
        header("location:mydashboard.php"); exit();
            //keep it inside session
            //redirect them back to dashboard.php and display the message.
            echo "Deleted successfully";

        }else{
            echo "Unable to delete";
        }
    }
?>