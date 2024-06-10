<?php
session_start();
require_once "user_guard.php";
// require_once("partials/header.php");
require_once "classes/Farmer.php";
require_once "classes/State.php";

$id =$_SESSION["useronline"];
$farmers = new Farmer;
$farmers = $farmers->get_farmer_by_id($id);

$states = new State;
$states = $states->fetch_states();

// echo "<pre>";
// print_r($states);
// echo "</pre>";
// die();
?>

<?php
require_once "partials/header.php";
?>
           <!-- banner on different farms and about farmers friend -->
<?php
require_once "partials/dashbody.php";
?>
                    <!-- Add product -->
                    <form class="row g-3 pb-5" id="viewpro" action="process/process_product.php" method="post" enctype="multipart/form-data">
                        <h6 class="profile">List of Products</h6>
                        <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Break-out Topics</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Breakout Topics</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            Presentation, discussion, or activity that takes place as part of a larger event for which some of the event's participants temporarily separate themselves from the others. 
                               &nbsp;&nbsp; 
                               <?php
                               if(isset($_SESSION['admin_errormsg'])){
                                echo "<div class='alert alert-danger'>". $_SESSION['admin_errormsg'] ."</div>";
                                unset($_SESSION['admin_errormsg']);
                               }
                               if(isset($_SESSION['admin_feedback'])){
                                echo "<div class='alert alert-success'>". $_SESSION['admin_feedback']. "</div>";
                                unset($_SESSION['admin_feedback']);
                               }
                               ?>
                               <a href="addtopic.php" class="btn btn-outline-primary">Add Topic</a>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Topics Created
                            </div>
                            <div class="card-body">
                               <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Level</th>
      <th scope="col">Cover</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(is_array($t)){
      $counter = 1;
      foreach($t as $breakout){
?>
<tr>
      <th scope="row"><?php echo $counter;?></th>
      <td><?php echo $breakout['topic_name'];?></td>
      <td><?php echo $breakout['level_name'];?></td>
      <td><img src="uploads/<?php echo $breakout['topic_img'];?>" height="40"></td>
      <td><a href="edit_topic.php?id=<?php echo $breakout['topic_id'];?>" class="btn btn-sm btn-primary">Edit</a> 
      <a onclick="return confirm('Are you sure you want to delete')" href="delete_topic.php?id=<?php echo $breakout['topic_id'];?>" class="btn btn-sm btn-danger">Delete</a> <a href="" class="btn btn-sm btn-success">Published</a></td>
  </tr>
<?php
$counter ++;
      }
    }
    ?>
    
     
  </tbody>
</table>
                            </div>
                        </div>
                    </div>
                </main>
                       
		</div>
	
        
          
                <!-- footer -->
<?php
    require_once "partials/footer.php";
?>