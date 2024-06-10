<?php
session_start();
require_once "classes/Programme.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
     // echo $_GET["id"];

        $del1 = new Programme;
        $response = $del1-> delete_programme($id);

        if($response){
             $_SESSION['feedback'] = 'Deleted successfully!';
        header("location:govdashboard.php"); exit();
            //keep it inside session
            //redirect them back to dashboard.php and display the message.

        }else{
            echo "Unable to delete";
        }
    }
?>