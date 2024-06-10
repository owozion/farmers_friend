<?php
session_start();
require_once "user_guard.php";
require_once "classes/Product.php";
require_once "classes/Farmer.php";

$farmer=new Farmer;

$f=new Farmer;

$product = new Product;
$cat1=$product->get_all_product_by_cat1();
$cat2=$product->get_all_product_by_cat2();
$cat3=$product->get_all_product_by_cat3();
$searched=$_SESSION['searched'];
// echo "<pre>";
// print_r($searched);
// // print_r($cat2);
// // print_r($cat3);
// echo "</pre>";
// die();


require_once "partials/header_dash.php";
?>
           <!-- banner on different farms and about farmers friend -->
            
            <!-- agricultural product -->
            <div class="row procolor">
                <!-- <div class="col-md-12 col-sm-12 head"><h2>AGRICULTURAL PRODUCE</h2></div> -->
            </div>
            <!-- product 1 -->
            <div class="row row-cols-md-4 row-cols-1 row-cols-lg-3 g-3 p-3 procolor">
                
                        <?php

                    foreach($searched as $product){

                print "<div class='col'> 
                            <div class= 'card m-3 p-3 shadow'>
                                <img src='uploads/".$product['product_image']."' class='card-img-top' alt=''>
                                <div class='card-body'>
                                    <p style='color: green; font-size:1.5rem; font-weight:bold;'>".$product['product_name']."</p>
                                    <h5>Quantity: ".$product['product_qty']."</h5>
                                    <h5>Price:&#8358; ".number_format($product['product_price'])."</h5>
                                    <a href='addtocart.php?id=".$product['product_id']."' class='btn btn-warning  mb-2 col-12'>Add to Cart</a>
                                </div>
                            </div>
                        </div>";

                    }
                        ?>
            </div>
          
           
            <!-- register -->
            <div class="row procolor">
                <div class="col-md-12 col-sm-12" id="meet"><h2>Contact Us</h2></div>
            </div>
            <!-- contact -->
             <div class="row procolor ">
                <div class="col-11 col-md m-3 produce text">
                    <h4>EMAIL SUPPORT</h4>
                    <p>help@farmer'sfriend.com</p>
                </div>
                <div class="col-11 col-md m-3 produce text">
                    <h4>PHONE SUPPORT</h4>
                    <p>07067509905</p>
                </div>
                <div class="col-11 col-md m-3 produce text">
                    <h4>WHATSAPP SUPPORT</h4>
                    <p>07067509905</p>
                </div>
                <div class="col-11 col-md m-3 produce text">
                    <h4>GET LATEST DEALS</h4>
                    <div class="d-flex">
                    <input type="text" class="form-control" placeholder="Email address">
                    <button class="btn btn-outline sub">Subscribe</button>
                    </div>
                </div>
            </div>
            <!-- footer -->
<?php
require_once "partials/footer.php";
?>