<div class="row procolor">
                <div class="col-md socialmedia">
                    <a href=""><img src="assets/images/twitter.png" alt="" href="#"></a>
                    <a href=""><img src="assets/images/facebook .png" alt=""></a>
                    <a href=""><img src="assets/images/instagram.png" alt=""></a>
                    <a href="#"><img src="assets/images/youtube.png" alt=""></a>
                    <h6>Copyright &copy 2024 Farmer'sfriend.com. All rights reserved</h6>
                </div>
            </div>
        </div>

        <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $('#state_id').change(function(){
                    let form_data = $(this).val();

                    $.ajax({
                        url:"state_server.php",
                        method:"post",
                        data: {form_data},
                        dataType: "text",
                        success:function(star){
                            if(star){
                                $('#lga').empty()
                                $('#lga').append(star);
                               
                            }

                        }

                    })
                })
            })
        </script>

        <script>

$(document).ready(function(){
$("#addproduct").hide();
$("#apply_form").hide();
$("#viewproduct").hide();
$("#editprofile").hide();
$("#viewapplication").hide();
$("#soldproduct").hide();

var soldpro =  $("#soldproduct");

$("#soldpro").click(function(){
    $("#editprofile").hide();
    $("#viewproduct").hide();
    $("#apply_form").hide();
    $("#viewapplication").hide();
    $("#addproduct").hide();
    soldpro.fadeIn().show().addClass('animate__animated animate__backInLeft');
    
});

var application =  $("#viewapplication");

$("#application").click(function(){
    $("#editprofile").hide();
    $("#viewproduct").hide();
    $("#apply_form").hide();
    $("#soldproduct").hide();
    $("#addproduct").hide();
    application.fadeIn().show().addClass('animate__animated animate__backInLeft');
    
});

var applyprog =  $("#apply_form");

$("#apply").click(function(){
    $("#editprofile").hide();
    $("#viewproduct").hide();
    $("#viewapplication").hide();
    $("#soldproduct").hide();
    $("#addproduct").hide();
    applyprog.fadeIn().show().addClass('animate__animated animate__backInLeft');
    
});
var addproduct =  $("#addproduct");

$("#addpro").click(function(){
    $("#editprofile").hide();
    $("#viewproduct").hide();
    $("#soldproduct").hide();
    $("#viewapplication").hide();
    $("#apply_form").hide();
    addproduct.fadeIn().show().addClass('animate__animated animate__backInLeft');
    
});

var editprofile = $("#editprofile");

$("#editpro").click(function(){
    $("#addproduct").hide();
    $("#viewproduct").hide();
    $("#soldproduct").hide();
    $("#viewapplication").hide();
    $("#apply_form").hide();
    editprofile.show().fadeIn().addClass("animate__animated animate__backInLeft");

});



var viewproduct = $("#viewproduct");

$("#viewpro").click(function(){
    $("#editprofile").hide();
    $("#addproduct").hide();
    $("#soldproduct").hide();
    $("#viewapplication").hide();
    $("#apply_form").hide();
    viewproduct.show().fadeIn().addClass("animate__animated animate__backInLeft");
    

});

});

    
</script>

    
</body>
</html>