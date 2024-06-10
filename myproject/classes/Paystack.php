<?php
error_reporting(E_ALL);
class Paystack{
    public function paystack_verify($reference){
        $headers=['content-Type: application/json', 'Authorization: Bearer sk_test_84563ac41bc1d9680e56d0e9c292126c08f68131'];
        $url = "https://api.paystack.co/transaction/verify/$reference";
        //step 1 = initialize curl
        $curlobj = curl_init($url);
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlobj, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
        $apiResponse = curl_exec($curlobj);//step3:
        if($apiResponse){
            curl_close($curlobj);//step 4
            return json_decode($apiResponse);//step 5: do anything
        }else{
        $r = curl_error($curlobj);
        //echo $r
        return false;
        }
    }
    public function paystack_initialize($email,$amt,$ref){
        //this function will generate the card details area for us
        $postRequest = ['email' => $email, 'amount' => $amt, 'reference' => $ref, "callback_url"=>"http://localhost/myproject/paydirect.php"];
        $headers=['content-Type: application/json', 'Authorization: Bearer sk_test_84563ac41bc1d9680e56d0e9c292126c08f68131'];
        $url = "https://api.paystack.co/transaction/initialize";
        //step 1 = initialize curl
        $curlobj = curl_init($url);
        //step2 = set curl options using the function curl_setopt()
        curl_setopt($curlobj, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curlobj, CURLOPT_POSTFIELDS, json_encode($postRequest));
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlobj, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
        //step 3 : execute the curl session using curl_exec()
        $apiResponse = curl_exec($curlobj);//willl return true(or the result)/false
        if($apiResponse){
            curl_close($curlobj);//step 4
            return json_decode($apiResponse);//step 5: do anything
        }else{
            $r = curl_error($curlobj);
            //echo $r
            return false;
        }




    }
}
?>