<?php

  //Session starts here
  session_start();
  // call for connection
  require_once('config.php') ;
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
    <a class="nav-link active " href="home.php" style="color:#f1aeb5;"><i class="fa fa-home" aria-hidden="true"><b>Home</b></i></a>
    <a class="nav-link " href="public.php"  style="color:#f1aeb5;"><i class="fa fa-eye" aria-hidden="true"><b>public</b></i>  </a>
    <a class="nav-link " href="profile.php"  style="color:#f1aeb5;"><i class="fa fa-user" aria-hidden="true"><b>Profile</b></i>  </a>
    <a class="nav-link " href="account.php" style="color:#f1aeb5;"><i class="fa fa-user-circle-o" aria-hidden="true"><b><?=$name?></b></i></a>
    <a class="nav-link" href="logout.php" style="color:#f1aeb5;"><i class="fa fa-power-off" aria-hidden="true"><b>Logout</b></i></a>
     
 </nav><br>
</header>
  <main>
    <div class="container-fluid">

       <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-12" style="float:left;background-color:#f1aeb5;height:95vh;">
          <div class="card" style="height:95vh;background-color:#f1aeb5;">
            <img class="card-img-top justify-content-center" src="./profile/<?=  $propic  ?>" alt="profile pic" style="border-radius:90px;width:30%;height:15vh;margin-left:30%;margin-top:2%;">
            <div class="card-body">
             <p>
             <h4 class="card-title text-center" style="font-family:italic;color:teal;"><b><?= $name ?>'s diary</b></h4>
             <div class="container">
                            <form method="post">
                              <div class="form-group row">
                                <label for="#inputName" class="col-sm-1-12 col-form-label " style="color:teal;"><b>Enter Diary Name:</b></label>
                                <div class="col-sm-1-12">
                                  <input type="text" class="form-control" name="txt_name" id="inputName" placeholder="Diary Name" value="<?php  $diary=isset($_POST['txt_name'])? $_POST['txt_name'] :""; ?>" required="required">
                                  <button type="submit"  name="btn_submit" class="btn btn-secondary" style="color:white;"><b><i class="fa fa-plus" aria-hidden="true"></i>Add New Diary</b></button>
                                </div>
                              </div><br>
                            </form>
                            <?php

                                  if(isset($_POST['btn_submit'])){

                                      $day=date('D');
                                      $date=date('y:m:d');
                                      $user;

                                      $res=$db->diaries->insertOne(array(
                                          'Day'=>$day,
                                          'Created_at'=>$date,
                                          'Diary'=>$diary,
                                          'Diary Owner'=>$user
                                      ));

                                      if(!$res){
                                        echo"Adding diary failed";
                                      }
                                      header("Location:home.php");

                                  }

                             ?>
                      </div>
                  
             </p>
             <h4 class="text-center" style="font-family:italic;color:teal;"><i class="fa fa-th-list" aria-hidden="true"></i><b>Your List of diaries</b></h4><br>
                    <?php  
                      
                             $fetch=$db->diaries->find( array('Diary Owner'=>$user));

                             foreach($fetch as $diary)
                             {

                             $diary_id= $diary['_id'];
                       ?>
                      
                       <ul class="list-group list-group-flush">
                        <a class="list-group-item text-center list-group-item-action active" href="home.php?activities=<?=  $diary_id  ?>" style="border-radius:10px;background-color:teal;"><i class="fa fa-pagelines" aria-hidden="true" style="color:#f1aeb5;"></i>   <b><?=  $diary['Diary'] ?></b>  <i class="fa fa-pagelines" aria-hidden="true" style="color:#f1aeb5;"></i></a><br>
                     
                       </ul>
                   

                    <?php } ?>
             </div>
               
                  
            </div>
          </div>
      
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-12"style="float:right;background-color:teal;height:95vh;overflow-y:scroll;">
                   <div class="card border-primary" style="background-color:teal;height:95vh;">
                     <div class="card-body">
                       <h4 class="card-title text-center " style="color:white;font-family:italic;"><b>Activities</b></h4><br>
                       <p class="card-text">
                          <?php  

                                  //Collect the diary Id to add activities into it

                                      if((!isset($_GET['activities']))){
                                               
                          ?>
                           <p>
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title text-center" style="font-family:italic;"><b>Tips on adding diaries and activities</b></h4>
                                  <p class="card-text">
                                    <ul class="list-group list-group-flush">
                                      <li class="list-group-item">Add a Diary on the left side of the screen</li>
                                      <li class="list-group-item ">The diary name will appear on the screen after you complete the form.</li>
                                      <li class="list-group-item ">On the diary list click the name of the diary</li>
                                      <li class="list-group-item">On the right side of the screen will appear a button</li>
                                      <li class="list-group-item ">Add activity button has appeared now click on it</li>
                                      <li class="list-group-item ">Complete the form and view your memories and activities recorded by you</li>
                                      <li class="list-group-item ">For descrete/confidential activities you will see them here on this web-page after adding the activity</li>
                                      <li class="list-group-item ">View the public activities on the public page <a href="public.php">here</a></li>
                                      <li class="list-group-item ">A single diary can have as many activities and you can create many diaries as well</li><br>
                                      <li class="list-group-item text-center "><i class="fa fa-smile-o" aria-hidden="true" style="color:orange;"></i> <b>Thank you!!!</b> <i class="fa fa-handshake-o" aria-hidden="true" style="color:brown;"></i></li>
                                   </ul>
                                  </p>
                                </div>
                              </div>
                           </p>
                            
                             
                           
                          <?php
                                        exit;
                                      }
                                      // Add activities form and Id condition 
                                      $get_id=$_GET['activities'];

                                      if(isset($get_id)){
                                      ?> 
                                      <p>
                                      <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#contentId2" aria-expanded="false"
                                      aria-controls="contentId2"  style="background-color:#f1aeb5;color:black;" >
                                      <i class="fa fa-plus-square" aria-hidden="true"></i><b>Add Activity</b>
                                      </button>
                                      </p>
                                      <div class="collapse" id="contentId2"> 
                                      <div class="container">
                                          <form method="post" action="" enctype="multipart/form-data">
                                              <div class="form-group row">
                                                <label for="inputName" class="col-sm-1-12 col-form-label" style="color:white;"><i class="fa fa-smile-o" aria-hidden="true" style="color:yellow;"></i> <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i> <b>Share your heart :</b> <i class="fa fa-heart" aria-hidden="true" style="color:#dc3545;"></i> <i class="fa fa-smile-o" style="color:yellow;"></i></label>
                                                <div class="col-sm-1-12">
                                                <textarea name="activity" id="input" class="form-control" rows="3" required="required" placeholder="Share your heart here" value="<?= "Dear diary" ?>"></textarea>
                                                </div>
                                              </div><br>
                                              <div class="form-group row">
                                                <label for="inputName" class="col-sm-1-12 col-form-label" style="color:white;"><i class="fa fa-camera" aria-hidden="true" style="color:black;"></i> <b>Memorial pics :</b></label>
                                                <div class="col-sm-1-12">
                                                <input class="form-control" type="file" name="uploadfile" value="" accept="image/*"  required="required"  multiple/>
                                                </div>
                                              </div><br>
                                              <div class="form-group row">
                                                <div class="form-group">
                                                  <label for="my-select" style="color:white;"><i class="fa fa-eye" aria-hidden="true" style="color:black;"></i> <b>View options</b></label>
                                                  <select id="my-select" class="form-control" name="category" required="required">
                                                  <option>Select Option..</i></option>
                                                    <option>Confidential</option>
                                                    <option>Public</option>
                                                  </select>
                                                </div>
                                              </div><br>
                                              <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                  <button type="submit" class="btn btn-secondary" name="btn_Act"><b>Add Activity</b></button>
                                                </div>
                                              </div>
                                            </form>
                                              <!-- //Add activities to the database -->
                                            <?php

                                                  if(isset($_POST["btn_Act"])){

                                                    $the_day=date('D');
                                                    $time=date('h:m:H');
                                                    $the_date=date('d/M/Y');
                                                    $activity=isset($_POST['activity'])? $_POST['activity']: "";
                                                    $view_category=isset($_POST['category'])? $_POST['category']: "";
                                                    
                                                    $filename = $_FILES["uploadfile"]["name"];
                                                    $tempname = $_FILES["uploadfile"]["tmp_name"];
                                                    $folder = "./images/" . $filename;

                                                   $activities=$db->activities->insertOne(array(
                                                      'Activity Day'=>$the_day,
                                                      'Time of Activity'=>$time,
                                                      'The date'=>$the_date,
                                                      'Activity'=>$activity,
                                                      'View Category'=>$view_category,
                                                      'Viewer_id'=> $user,
                                                      'Diary_id'=>$get_id,
                                                      'Image'=>$filename,
                                                      'User Profile'=>$propic,
                                                      'User Name'=>$name

                                                    ));

                                                   

                                                      move_uploaded_file($tempname, $folder);
                                                     // header("Location:home.php?activities=".$user);
                                                  }
                                            ?>

                                      </div>
                                      <!-- //Fetch activities and their data -->
                                      <?php

                                                    $recent_act=$db->activities->find(array('Viewer_id'=> $user, 'Diary_id'=>$get_id));
                                                    foreach($recent_act as $memo)
                                                    {
                                                      $the_event=$memo['Activity'];
                                                      $the_event_time=$memo['Time of Activity'];
                                                      $the_event_date=$memo['The date'];
                                                      $event_descretion=$memo['View Category'];
                                                      $picture=$memo['Image'];
                                                      $that_day=$memo['Activity Day'];
                                                      

                                                      if($event_descretion=='Confidential' || $event_descretion=='confidential'){

                                                    
                                                    ?>
                                                    
                                                   
                                      </div>
                                          <p><div class="card" style="height:fit-content;">
                                              <div class="card-header">
                                                <h5><?=   $that_day.", " .$the_event_date     ?></h5>
                                              </div>
                                              <div class="card-body">
                                                  <h5 class="card-title"><?=  $event_descretion  ?></h5>
                                                    <img src="./images/<?= $picture   ?>" alt="" style="width:20%;">
                                                  <p class="card-text"><?=  $the_event  ?></p>
                                              </div>
                                              <div class="card-footer">
                                                  Time: <?= $the_event_time   ?>
                                              </div>
                                              <?php  }} ?><br>
                                         </div></p>
                                          <?php } ?>
                                     
                                </p>
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