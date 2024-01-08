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
    <a class="nav-link " href="home.php" style="color:#f1aeb5;"><i class="fa fa-home" aria-hidden="true"><b>Home</b></i></a>
    <a class="nav-link " href="public.php"  style="color:#f1aeb5;"><i class="fa fa-eye" aria-hidden="true"><b>public</b></i>  </a>
    <a class="nav-link active " href="profile.php"  style="color:#f1aeb5;"><i class="fa fa-user" aria-hidden="true"><b>Profile</b></i>  </a>
    <a class="nav-link  " href="account.php" style="color:#f1aeb5;"><i class="fa fa-user-circle-o" aria-hidden="true"><b><?=$name?></b></i></a>
    <a class="nav-link" href="logout.php" style="color:#f1aeb5;"><i class="fa fa-power-off" aria-hidden="true"><b>Logout</b></i></a>
     
 </nav><br>
</header>
     
<div class="container-fluid">
    <?php  include_once ('user_details.php'); ?>
    <?php 
        $user=$_SESSION['user'];
        $count=0;
         $posts=$db->diaries->find(array('Diary Owner'=>$user));
         foreach($posts as $single_diary)
         {
            $count=$count+1;
         }
    ?>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:40vh;background-color:teal;">

           <img class="card-img-top justify-content-center"  src="./profile/<?=  $propic  ?>" alt="profile pic" style="border-radius:150px;width:13%;height:25vh;margin-left:43%;margin-top:25vh;" >
          
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#f1aeb5;height:45vh;">
      <br><br><br><p class="text-center" style="color:teal;font-family:italic; font-size:25px;" >🤜 <?=  $name." ".$surname   ?> 🤛 </p>
      <p class="text-left" style="color:teal;font-family:italic; font-size:25px;" >📧  Email: <?= $user_mail  ?></p>
      <p class="text-left"style="color:teal;font-family:italic; font-size:25px;">📓 Number of diaries: <?=  $count ?></p>
    </div>
    
</div>

  
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