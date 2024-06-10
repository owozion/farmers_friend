            <div class="row procolor">
                <div class="col-md socialmedia">
                    <a href=""><img src="assets/images/twitter.png" alt="" href="#"></a>
                    <a href=""><img src="assets/images/facebook .png" alt=""></a>
                    <a href=""><img src="assets/images/instagram.png" alt=""></a>
                    <a href="#"><img src="assets/images/youtube.png" alt=""></a>
                    <h6>Copyright &copy <?php print date("Y") ?> Farmer'sfriend.com. All rights reserved</h6>
                </div>
            </div>
        </div>

        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/jquery.js"></script>
        <script>

$(document).ready(function(){
    $("#editprofile").hide();
    $("#listproduct").hide();
    $("#viewproduct").hide();
    $("#listgovernment").hide();
    $("#listngo").hide();
    $("#listcust").hide();
    $("#listall").hide();
    $("#soldproduct").hide();

    var soldpro =  $("#soldproduct");

$("#soldpro").click(function(){
    $("#editprofile").hide();
    $("#viewproduct").hide();
    $("#listproduct").hide();
    $("#listngo").hide();
    $("#listgovernment").hide();
    $("#listcust").hide();
    soldpro.fadeIn().show().addClass('animate__animated animate__backInLeft');
});


    var showall =  $("#listall");

    $("#showall").click(function(){
        $("#editprofile").hide();
        $("#viewproduct").hide();
        $("#listproduct").hide();
        $("#listngo").hide();
        $("#listgovernment").hide();
        $("#listcust").hide();
        showall.fadeIn().show().addClass('animate__animated animate__backInLeft');
    });

    var showcust =  $("#listcust");

    $("#showcust").click(function(){
        $("#editprofile").hide();
        $("#viewproduct").hide();
        $("#listproduct").hide();
        $("#listngo").hide();
        $("#listgovernment").hide();
        showcust.fadeIn().show().addClass('animate__animated animate__backInLeft');
    });

    var showngo =  $("#listngo");

    $("#showngo").click(function(){
        $("#editprofile").hide();
        $("#viewproduct").hide();
        $("#listproduct").hide();
        $("#listgovernment").hide();
        $("#listcust").hide();
        showngo.fadeIn().show().addClass('animate__animated animate__backInLeft');
    });

    var showgov =  $("#listgovernment");

    $("#showgov").click(function(){
        $("#editprofile").hide();
        $("#viewproduct").hide();
        $("#listproduct").hide();
        $("#listcust").hide();
        $("#listngo").hide();
        showgov.fadeIn().show().addClass('animate__animated animate__backInLeft');
        
    });

    var addproduct =  $("#listproduct");

    $("#addpro").click(function(){
        $("#editprofile").hide();
        $("#viewproduct").hide();
        $("#listgovernment").hide();
        $("#listcust").hide();
        $("#listngo").hide();
        addproduct.fadeIn().show().addClass('animate__animated animate__backInLeft');
        
    });

    var editprofile = $("#editprofile");

    $("#editpro").click(function(){
        $("#listproduct").hide();
        $("#viewproduct").hide();
        $("#listgovernment").hide();
        $("#listcust").hide();
        $("#listngo").hide();
        editprofile.show().fadeIn().addClass("animate__animated animate__backInLeft");

    });



    var viewproduct = $("#viewproduct");

    $("#viewpro").click(function(){
        $("#editprofile").hide();
        $("#listproduct").hide();
        $("#listgovernment").hide();
        $("#listcust").hide();
        $("#listngo").hide();
        viewproduct.show().fadeIn().addClass("animate__animated animate__backInLeft");
        

    });

});
       
</script>

    
</body>
</html>