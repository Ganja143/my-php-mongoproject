<?php

  //Session starts here
  session_start();
  // call for connection
  require_once('config.php') ;
  error_reporting(0);
  //Checking if the user is logged in to access this page
  if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/bootstrap.css">
<title>Title</title>
</head>
<body>
<?php  require 'user_details.php' ;  ?>
<header>
    <!-- place navbar here -->
    
    
    <nav class="nav nav-tabs nav-stacked bg-dark justify-content-end">
    <h4 class="nav-link justify-content-left" style="color:white;margin-right:55%;font-family:italic;"><b>Diary App</b></h4>
    <a class="nav-link  " href="home.php" style="color:#f1aeb5;"><i class="fa fa-home" aria-hidden="true"><b>Home</b></i></a>
    <a class="nav-link active" href="public.php"  style="color:#f1aeb5;"><i class="fa fa-eye" aria-hidden="true"><b>public</b></i>  </a>
    <a class="nav-link  " href="profile.php"  style="color:#f1aeb5;"><i class="fa fa-user" aria-hidden="true"><b>Profile</b></i>  </a>
    <a class="nav-link " href="account.php" style="color:#f1aeb5;"><i class="fa fa-user-circle-o" aria-hidden="true"><b><?=$name?></b></i></a>
    <a class="nav-link" href="logout.php" style="color:#f1aeb5;"><i class="fa fa-power-off" aria-hidden="true"><b>Logout</b></i></a>
     
 </nav><br>
</header>
  <main>
    <div class="container-fluid" >

       <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-12" style="float:left;background-color:#f1aeb5;height:95vh;">
          <div class="card" style="height:95vh;background-color:#f1aeb5;">
            <div class="card-body">
             <p>
             <h4 class="card-title text-center" style="font-family:italic;color:teal;"><b>Public Memories</b></h4>
             <div class="container">
                      </div>
                  
             </p><br>
             <h5 class="text-center" style="font-family:italic;color:teal;"><i class="fa fa-th-list" aria-hidden="true"></i><b>Your List of public actvities</b></h5><br>
                    <?php  
                             $cat="Public";
                             $fetch=$db->activities->find( array('View Category'=>$cat));

                             foreach($fetch as $acts)
                             {

                             $act_id= $acts['_id'];
                       ?>
                      
                       <ul class="list-group list-group-flush">
                        <a class="list-group-item text-center list-group-item-action active" href="public.php?activities=<?=  $act_id  ?>" style="border-radius:10px;background-color:teal;"><i class="fa fa-pagelines" aria-hidden="true" style="color:#f1aeb5;"></i>   <b><?=  $acts['The date'] ?></b>  <i class="fa fa-pagelines" aria-hidden="true" style="color:#f1aeb5;"></i></a><br>
                       </ul>
                   

                    <?php } ?>
             </div>
               
                  
            </div>
          </div>
      
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-12"style="float:right;background-color:teal;height:95vh;overflow-y:scroll;">
                   <div class="card border-primary" style="background-color:teal;height:95vh;">
                       <div class="card-body">
                            <h4 class="card-title text-center " style="color:white;font-family:italic;"><b>Activity</b></h4><br>
                            <p class="card-text">
                                
                                   <?php  

                                        //Fetch activities and their data 
                                        if((!isset($_GET['activities']))){              
                                    
                                             
                                    ?>
                                      
                                       
                                        <form action="" method="post">
                                        <input class="form-control text-center mr-sm-2" type="search" name="txt_search" placeholder="Search by name of a person" aria-label="Search" required="required" value="<?php $search=isset($_POST['txt_search'])? $_POST['txt_search'] :"";   ?>">
                                        <button class="btn btn-secondary my-2 my-sm-0" name="btn_search" type="submit"> <i class="fa fa-search" aria-hidden="true"></i>Search</button>
                                        </form>
                                            <?php
                                                 
                                                  if(isset($_POST['btn_search'])){

                                                      $search_value=$db->activities->find(array('User Name'=>$search, 'View Category'=>'Public')); 

                                                      if(empty($search_value==[0])){
                                                        echo'';
                                                        echo'<p style="color:white;font-size:24px;"><b><i class="fa fa-eye-slash" aria-hidden="true" style="color:yellow"></i> Oops! No data was found</b> </p>';
                                                      }

                                                      foreach ($search_value as $pub){
                                            ?>
                                                      <p><div class="card" >
                                                              <div class="card-header">
                                                                <a href="all_profile.php?name=<?= $pub['Viewer_id']  ?>"style="text-decoration:none;color:indigo;"><img src="./profile/<?= $pub['User Profile']  ?>" class="img-fluid" alt="" style="width:5%;height:7vh;border-radius:146px;"> <b><?= "  ".$pub['User Name']   ?></b></a>
                                                                <span style="float:right;color:indigo;"><b><?=$pub['The date']   ?></b></span>
                                                              </div>
                                                              <div class="card-body">
                                                                <h6 class="card-title"></h6>
                                                                <p class="card-text">
                                                                  <p style="color:indigo;"><?= $pub['Activity']  ?></p><br>
                                                                  <p><img src="./images/<?= $pub['Image'] ?>" alt="" style="width:20%;"></p><br>

                                                                <p style="color:indigo;"><?=  $pub['Activity Day'].",  ".$pub['Time of Activity']  ?></p>
                                                                </p>
                                                              </div>
                                                              <div class="card-footer text-muted">
                                                              <p>space for comments</p>
                                                              </div>
                                                           </div>
                                                       </p>
                                        <?php
                                                  }}
                                              exit;
                                              }
                                              // Add activities form and Id condition 
                                              $get_id=$_GET['activities'];

                                              if(isset($get_id)){
                                                
                                                // $get_id=$_GET['activities'];
                                                $dat=$db->activities->findOne(array('_id'=> new MongoDB\BSON\ObjectID("$get_id")));
                                                  ?>

                                               <div class="card">
                                                  <div class="card-header">
                                                    <a href="all_profile.php?name=<?= $dat['Viewer_id']  ?>" style="text-decoration:none;color:indigo;;"><img src="./profile/<?= $dat['User Profile']  ?>" class="img-fluid" alt="" style="width:5%;height:7vh;border-radius:146px;">  <b><?= "  ".$dat['User Name']   ?></b></a>
                                                    <span style="float:right;color:indigo;"><b><?= $dat['The date']  ?></b></span>
                                                  </div>
                                                  <div class="card-body">
                                                    <h6 class="card-title"></h6>
                                                    <p class="card-text">
                                                      <p style="color:indigo;"><?= $dat['Activity']  ?></p><br>
                                                      <p><img src="./images/<?= $dat['Image'] ?>" alt="" style="width:20%;"></p><br>

                                                    <p style="color:indigo;"><?=  $dat['Activity Day'].",   ".$dat['Time of Activity']  ?></p>
                                                    </p>
                                                  </div>
                                                  <?php 
                                                       require_once('create_views.php');

                                                       $get_id2=$_GET['activities'];
                                                       $act_id2=new MongoDB\BSON\ObjectID("$get_id2");
                                                       
                                                       $all_views=$db->views->find(array( 'Activity Id'=>$act_id2));

                                                       foreach($all_views as $view){

                                                       $view_num=$view['Views'];
                                                       
                                                       }
                                                  ?>
                                                  
                                                  <div class="card-footer text-muted" >
                                                       <p><i class="fa fa-eye fa-2x" aria-hidden="true" style="color:indigo;"></i><?= " ".$view_num  ?> <span style="float:right;"><i class="fa fa-comments fa-2x" aria-hidden="true" style="color:indigo;"></i></span></p>
                                                  </div>
                                              
                                              </div>
                            </p> 
                            <?php  } ?>
                         </div>
                              

                      </div>
                     
                 </div>   
      </div>
  </main>

  
  <!-- Bootstrap JavaScript Libraries -->
 
    <script src="./js/jquery-3.3.1.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/jquery.ajaxchimp.min.js"></script>
    <script src="./js/jquery-2.1.4.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/jquery.flexslider-min.js"></script> 
</body>
</html>
<?php
   
        }else{
            
          //If the user is not logged in they are redirected to the login
            header("Location:login.php");
        }  
      
?>