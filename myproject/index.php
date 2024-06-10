<?php
session_start();

require_once("classes/Programme.php");
require_once("classes/State.php");
require_once("classes/Farmer.php");

$f=new Farmer;

// print_r($_SESSION['useronline2']);
// var_dump($_SESSION['useronline2']);

// die;

// $id =$_SESSION["useronline"];
// $farmers = new Farmer;
// $farmers = $farmers->get_farmer_by_id($id);

$programme = new Programme;
$progs = $programme->fetch_prog();

// echo "<pre>";
// print_r($progs);
// echo "<pre>";
// die();

require_once("partials/header.php");

?>
           <!-- banner on different farms and about farmers friend -->
            <div class="row my-3">
            <?php
                            if(isset($_SESSION['errormsg3'])){
                            echo "<div class='alert alert-danger'>" .$_SESSION['errormsg3']."</div>";
                            unset($_SESSION['errormsg3']); 
                            }
            ?>
                <div class="col-lg-8 col-sm-12 shadow p-3">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active" >
                            <img src="assets/images/cerealfarm2.png" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/pig1.png" class="d-block w-100" alt="cerealfarm">
                          </div>
                          <div class="carousel-item">
                            <img src="assets/images/animalfish.png" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
                <div class="col-lg-4 col-sm-12 shadow  p-3"  id="abouts">
                    <h2 class="about">About Farmer's friend</h2>
                    <span style=" display:block; text-align:justify;">Farmer's friend is a web application that tends to bridge the gap between Government/NGO agricultural support initiatives and farmers. Most often than not, agricultural support programme being carried out by different government/NGO hardly gets to the farmers. Some farmers end up buying things like agro-chemical, improved seeds, fertilizer etc that the government/ngo had already commissioned to be given to the farmers free of charge where by increasing their cost of production and making most farmers settle at the subsistent level even if they wish to increase production and expand. </span><br>
                    <span style=" display:block; text-align:justify;">I forsee that this will also bridge the gap between demand and supply as registered farmers will be able to upload their produce, product and livestocks stating the available quantity. This will give manufacturals both within and outside the country access to raw materials at affordable rate and will encourage farmers to go into commercial production as there is ready market irrespective of the quantity of the produce/product.</span>
                </div>
            </div>
            <!-- Header on ongoing agric support programme -->
            <div class="row head">
                <div class="col-md-12"><h2>On going agricultural Support Programme</h2></div>
            </div>
            <!-- banner on ongoing agric support programme and goal -->
            <!-- <div class=" row ">
            <div class=" fly_in" id="fly">
                <a class="alert alert-success" href="register.php" style="color: green; font-weight:bold; font-size:larger ">Click to Register</a>
            </div>
            </div> -->
        <div class="row ">
            <div>    <?php
                if (isset($_SESSION["feedback"])){
                    echo "<div class='alert alert-success'>".$_SESSION["feedback"]."</div>";
                    unset($_SESSION["feedback"]);
                }
                if (isset($_SESSION["errormsg"])){
                    echo "<div class='alert alert-danger'>".$_SESSION["errormsg"]."</div>";
                    unset($_SESSION["errormsg"]);
                }
                ?></div>
                <div class="col-md-4 my-4" style=" display:flex; justify-content:center;">

                    <img src="assets/images/sugarcanefarm.png" alt="improved seed" class="shadow">
                    
                </div>
                <div class="col my-4 img-fluid" style=" display:flex; justify-content:center;">
                    <!-- <img src="assets/images/sugarcanefarm.png" alt="improved seed" class="py-3 px-1 mx-2 "> -->

                    <img src="assets/images/sugarcanefarm.png" alt="improved seed" class="shadow">      
                    
                </div>
                <div class="col-md-4 shadow m-3 ">
                    <h4 style="color:green">Operation Improved Seeds</h4>
                    <span>This agricultural support initiative is meant to provide farmers with improved seed that will increase yield by 75%</span><br><br>
                    <span>We employ farmers who are yet to register on this platform to do so.</span><br><br>
                    <span>Please note that the improved seeds will only be distributed to registered farmers.</span><br><br>
                    <button class="btn green  mb-2 col-12" id="apply">Click to Apply</button>
                </div>
            </div>

            <div class="row head" style="position: fixed; top: 300px; right: -30px; transform: translateY(-35%); transition:center 0.5s; z-index:1;">
            <div class="col-md-11 pt-5" id="apply_form" style=" display:flex; justify-content:center; position:sticky; top:100px; bottom:0;">
                    <form action="process/process_apply.php" method="post" class="p-5 box g-3" >
                    <h6 class="profile" style="color: black">Apply</h6>
                        <div class="col-md-12">
                            <label for="inputname" class="form-label" style="color: black">Fullname Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputquantity" class="form-label" style="color: black">Do you plant or rear livestock?</label>
                            <input type="text" name="category" class="form-control" id="category" required>
                        </div>
                        <div class="col-md-12">
                            <label for="price" class="form-label" style="color: black">Type of Crop or Livestock</label>
                            <input type="text" name="type" class="form-control" id="type"required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputquantity" class="form-label" style="color: black">Yearly Turnover</label>
                            <input type="number" name="turnover" class="form-control" id="turnover" placeholder="e.g 1,000,000" required>
                        </div>

                        <div class="col-md-12">
                            <label for="" class="form-label" style="color:black ">Choose Programme</label>
                            <select name="cat" id="cat" class="form-select">
                        <option value="">Select One</option>
                        <?php
                        foreach($progs as $prog){
                            $pname = $prog['programme_name'];
                            $pid = $prog['programme_id'];

                            echo "<option value='$pid'>$pname</option>";
                        }
                        ?>
                        </select>
                        </div>
                        <div class="m-2">
                            <input type="hidden" name="id" value="<?php echo $_SESSION['useronline'];?>">
                            <button class="btn green col-10" name="btnsubmit" value="submit">Submit</button>
                        </div>
                            <?php
                            if(isset($_SESSION['errormsg'])){
                            echo "<div class='alert alert-danger'>" .$_SESSION['errormsg']."</div>";
                            unset($_SESSION['errormsg']); 
                            }
                            ?>
                    </form>
                </div>
            </div>
            
            <!-- agricultural produce -->
            <div class="row head">
                <div class="col-md shadow" id="shoping"><h2>Agricultural Produce</h2></div>
            </div>
            <!-- produce 1 -->
        <div class="row row-cols-md-4 row-cols-1 row-cols-lg-3 g-3 p-3 procolor">
            <div class='col'> 
                <div class= 'card m-3 p-3 shadow'>
                    <img src=assets/images/maiz.png class="card-img-top mt-2" alt="maize">
                    <div class="card-body">
                    <p style="color: green; font-size:1.5rem; font-weight:bold;">Sweet Maize</p>
                    <h5>Quantity:1</h5>
                    <h5>Price:&#8358; 50</h5>
                    <a href="shop.php" class='btn btn-warning shoplink mb-2 col-12'  style='color: white; font-weight:bold;'>Click to Shop</a>
                    </div>
                </div>
            </div>
            <div class='col'> 
                <div class= 'card m-3 p-3 shadow'>
                    <img src=assets/images/toma.png class="card-img-top mt-2" alt="toma">
                    <div class="card-body">
                    <p style="color: green; font-size:1.5rem; font-weight:bold;">Fresh Tomatoes</p>
                    <h5>Quantity:1 Basket</h5>
                    <h5>Price:&#8358; 10,000</h5>
                    <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                    </div>
                </div>
            </div>
            <div class='col'> 
                <div class= 'card m-3 p-3 shadow'>
                    <img src=assets/images/ribbe.png class="card-img-top mt-2" alt="Fruit">
                    <div class="card-body">
                    <p style="color: green; font-size:1.5rem; font-weight:bold;">Fresh fruit</p>
                    <h5>Quantity:1 Basket</h5>
                    <h5>Price:&#8358; 5,000</h5>
                    <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                    </div>
                </div>
            </div>
            <div class='col'> 
                <div class= 'card m-3 p-3 shadow'>
                    <img src=assets/images/waterme.png class="card-img-top mt-2" alt="waterme">
                    <div class="card-body">
                    <p style="color: green ; font-size:1.5rem; font-weight:bold;">Fresh Watermelon</p>
                    <h5>Quantity:1</h5>
                    <h5>Price:&#8358; 3,00</h5>
                    <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                    </div>
                </div>
            </div>
        </div> 
           
            <!-- agricultural product -->
            <div class="row procolor">
                <div class="col-md shadow head"><h2>Agricultural Product</h2></div>
            </div>
           
            <div class=" row row-cols-md-4 row-cols-1 row-cols-lg-3 g-3 p-3 procolor">
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/chees.png class="card-img-top mt-2" alt="chees">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Fresh Chees</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 1,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>

                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/cashnu.png class="card-img-top mt-2" alt="cashew nut">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Cashew nuts</p>
                        <h5>Quantity:1 Paint</h5>
                        <h5>Price:&#8358; 6,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/ega.png class="card-img-top mt-2" alt="egg">
                        <div class="card-body">
                        <p style="color: green; font-size:1.5rem; font-weight:bold;">Egg</p>
                        <h5>Quantity:1 Crate</h5>
                        <h5>Price:&#8358; 2,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/mackerelsteckerlfisch.png class="card-img-top mt-2" alt="fish">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Steckerlfisch</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 1,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
            </div>
           
            <!-- livestock -->
            <div class="row procolor">
                <div class="col-md shadow head"><h2>Agricultural Livestock</h2></div>
            </div>
            
            <div class="row row-cols-md-4 row-cols-1 row-cols-lg-3 g-3 p-3 procolor">
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/cock.png class="card-img-top mt-2" alt="cock">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Cock</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 3,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/cow.png class="card-img-top mt-2" alt="cow">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Cow</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 200,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/ram.png class="card-img-top mt-2" alt="waterme">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Ram</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 100,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                <div class='col'> 
                    <div class= 'card m-3 p-3 shadow'>
                        <img src=assets/images/wildcatfish.png class="card-img-top mt-2" alt="wildcatfish">
                        <div class="card-body">
                        <p style="color: green ; font-size:1.5rem; font-weight:bold;">Wild Catfish</p>
                        <h5>Quantity:1</h5>
                        <h5>Price:&#8358; 1,000</h5>
                        <a href="shop.php" class='btn btn-warning  mb-2 col-12' style="color: white; font-weight:bold;">Click to Shop</a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row procolor">
                <div class="col-md produce  "> 
                    <!-- <button type="submit" class="btn btn-outline-success  col-md-6 shop" href="shop.html">Keep Shoping</button> -->
                </div>
            </div>
           
            <!-- register -->
            <div class="row procolor">
                <div class="col-md" id="contact"><h2 class="head shadow">Contact Us</h2></div>
            </div>
            <!-- contact -->
            <div class="row procolor">
                <div class="col-11 col-md m-3 shadow  produce text">
                    <h4>EMAIL SUPPORT</h4>
                    <p>help@farmer'sfriend.com</p>
                </div>
                <div class="col-11 col-md m-3 shadow  produce text">
                    <h4>PHONE SUPPORT</h4>
                    <p>07067509905</p>
                </div>
                <div class="col-11 col-md m-3 shadow  produce text">
                    <h4>WHATSAPP SUPPORT</h4>
                    <p>07067509905</p>
                </div>
                <div class="col-11 col-md m-3 shadow  produce text">
                    <h4>GET LATEST DEALS</h4>
                    <div>    <?php
                if (isset($_SESSION["feedback2"])){
                    echo "<div class='alert alert-success'>".$_SESSION["feedback2"]."</div>";
                    unset($_SESSION["feedback2"]);
                }
                if (isset($_SESSION["errormsg2"])){
                    echo "<div class='alert alert-danger'>".$_SESSION["errormsg2"]."</div>";
                    unset($_SESSION["errormsg2"]);
                }
                ?></div>
                    <form action="process/process_sub.php" method="post">
                        <div class="d-flex">
                        <input type="email" class="form-control" placeholder="Email address" name="email">
                        <!-- <button class="btn green col-10" name="btnsubmit" value="submit">Submit</button> -->
                        <button class="btn btn-outline sub" name="subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- footer -->
           <?php
           require_once("partials/footer.php");
           ?>