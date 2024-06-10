<?php
    class Cart{

        public function add($id){
            if(isset($_SESSION['products'])){
            array_push($_SESSION['products'],$id);
            }else{
                $_SESSION['products'] = [];
                array_push($_SESSION['products'],$id);
            }
        }

        public function addToCart($id){
            if(isset($_SESSION['products'])){

                if(array_key_exists("products",$_SESSION)){//this particular productshas been added to cart before
                    $existing_qty = $_SESSION['products'][$id];
                    $_SESSION['products'][$id] = $existing_qty + 1;
                }else{
                    //this particular products has not been added to cart before
                    $_SESSION['products'][$id] = 1;
                }

                }else{
                    $_SESSION['products'][$id] = 1;
                }
        }
    }
?>