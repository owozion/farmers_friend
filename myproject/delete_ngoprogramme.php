<?php
session_start();
require_once "classes/Programme.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
     // echo $_GET["id"];

        $del2 = new Programme;
        $response = $del2-> delete_programme_two($id);

        if($response){
            $_SESSION['feedback'] = 'Deleted successfully!';
        header("location:ngodashboard.php"); exit();
            //keep it inside session
            //redirect them back to dashboard.php and display the message.

        }else{
            echo "Unable to delete";
        }
    }
?>