<?php


require_once('config.php');

 error_reporting(0);

  // call for connection
  require 'logincode.php';
  session_start();
  if(!isset($_SESSION['user'])){

?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <style>
  *.{
    margin:0;
    padding:0;
    /* box-sizing:border-box; */

  }
  .body{
    background-color:teal;
    opacity: 0.9;
  }
 

 </style>
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="./css/bootstrap.css" rel="stylesheet">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/font-awesome.min.css" rel="stylesheet">
 

</head>

<body class="body">
  <header>
    <!-- place navbar here -->
    <a href="login.php" style="text-decoration:none; background-color: teal;color:white;"><i class="fa fa-fast-backward" aria-hidden="true"></i> <b>Login</b></a>
  </header>
  <main>
            
  <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 my-12 py-12 col-12" style="margin-left:20%;">

<div class="card">
        <div class="card-body">
           <h3 class="card-title text-center" style=" color: teal; font-size:30px;">SIGN UP</h3>
               <br><p class="card-text">
                <form action="" method="post"  enctype="multipart/form-data">
                <div class="form-group">
                        <label for="my-input1">Name:</label>
                        <input id="my-input1" class="form-control" type="text" name="txtname" value="<?php $fname=isset($_POST['txtname'])? $_POST['txtname'] :"";   ?>" required="required" >
                    </div><br>
                   <div class="form-group">
                        <label for="my-input2">Surname:</label>
                        <input id="my-input2" class="form-control" type="text" name="txtsurname" value="<?php $lname=isset($_POST['txtsurname'])? $_POST['txtsurname'] :"";   ?>" required="required" >
                    </div><br>
                    <div class="form-group">
                        <label>Profile Pic:</label>
                        <input  class="form-control" type="file" name="pro" accept="image/*" required="required" >
                    </div><br>
                    <div class="form-group">
                        <label for="my-input4">Username:</label>
                        <input id="my-input4" class="form-control" type="email" name="uname" value="<?php $mail=isset($_POST['uname'])? $_POST['uname'] :"";   ?>" required="required">
                    </div><br>
                    <div class="form-group">
                        <label for="my-input5">Password:</label>
                        <input id="my-input25" class="form-control" type="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"    name="pass" value="<?php $pass=isset($_POST['pass'])? $_POST['pass'] :"";   ?>" required="required" >
                          <br> <div class="alert alert-info alert-dismissible fade show" role="alert">
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             <strong>Password settings</strong> 
                                  <p>1. Must contain at least lower case letter</p>
                                  <p>2. Must have at least one number</p> 
                                  <p>3. Must have at least one special character</p>
                                  <p>4 Must be 8 characters long</p>
                                  <p>5. Must have at least one Uppercase</p>
                           </div>
                           
                           <script>
                             var alertList = document.querySelectorAll('.alert');
                             alertList.forEach(function (alert) {
                               new bootstrap.Alert(alert)
                             })
                           </script>
                           
                    </div>
                    <br><br><div class="form-group">
                      <button type="submit" name="btn_submit" class="btn" style="width:30%; margin-left:37%;color:white; background-color:teal;"><b>Sign-Up</b></button>
                    </div>
                </form>
            </p>
        </div>
    </div>
</div>   



<?php

if(isset($_POST['btn_submit'])){

    $fname=ucfirst($fname);
    $lname=ucfirst($lname);
    $mail=strtolower($mail);

    //file convention
    $filename = $_FILES["pro"]["name"];
    $tempname = $_FILES["pro"]["tmp_name"];
    $folder = "./profile/" . $filename;
    // move_uploaded_file($tempname, $folder);

   
    //check if email has been registered before
    
    if(isset($mail))
    {
            
       

       $res=$db->users->findOne(array('Username'=>$mail));
        if($res)
        {
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <strong>Oops</strong>
          Email already exists...
        </div>
        
        <script>
          var alertList = document.querySelectorAll('.alert');
          alertList.forEach(function (alert) {
            new bootstrap.Alert(alert)
          })
        </script>
    <?php

        }else{

          $pass=hash('sha256',$pass);
              $result=$db->users->insertOne(array(

                'name'=>$fname,
                'surname'=>$lname,
                'profile'=>$filename,
                'Username'=>$mail,
                'password'=>$pass

              ));
              if($result){

              move_uploaded_file($tempname, $folder);
              header("Location:login.php");
        }
      }
    }
  }
     ?>
        

    

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="./js/jquery-3.3.1.slim.min.js"></script>
  <script src="./js/jquery.ajaxchimp.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/wow.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.js"></script>
  <script src="./js/owl.carousel.min.js"></script>
</body>

</html>
<?php   }else{
        header("Location:home.php");
    } ?>