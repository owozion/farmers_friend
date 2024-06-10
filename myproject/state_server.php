<?php 
require_once "classes/State.php";

$lga = new State;



    $state_id = $_POST['form_data'];

   

    $data = $lga->fetch_lga_by_stateid($state_id);
    

    if($data){

    
        $local = "";

    
    foreach($data as $dat){

    $lga_id = $dat['lga_id'];
    $lga_name = $dat['lga_name'];

    $option = "<option value='$lga_id'>".$lga_name."</option>";

    $local .= $option;
    }
    echo $local;
}






?>