<?php

 session_start();
 require 'logincode.php'; 

 if(isset($_SESSION['user']))
 {
   header("Location:home.php");
 }

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
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/bootstrap.css" rel="stylesheet">
  <link href="./css/font-awesome.min.css" rel="stylesheet">

</head>

<body class="body">
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 my-12 py-12 col-12" style="margin-left:20%; margin-top:12vh;">

      <div class="card">
              <div class="card-body">
                  <h3 class="card-title text-center" style=" color: teal; font-size:30px;">SIGN IN</h3>
                     <br><p class="card-text">
                      <form action="" method="post">
                          <div class="form-group">
                              <label for="my-input">Username:</label>
                              <input id="my-input" class="form-control" type="email" name="username" required="required">
                          </div><br>
                          <div class="form-group">
                              <label for="my-input2">Password:</label>
                              <input id="my-input2" class="form-control" type="password"   name="password" required="required">
                          </div>
                          <br>Don't have an account? <a href="register.php" style="text-decoration:none;color:teal;">Register here</a>               <a href="forgot.php" style="Float:right;text-decoration:none;color:teal;">Forgot Password?</a><br>
                          <br><br><div class="form-group">
                            <b><input type="submit" name="btn_login" class="btn" style="width:30%; margin-left:37%;color:white;background-color:teal;" value="Login"></b>
                          </div>
                      </form>
                  </p>
              </div>
          </div>
      </div> 
      <?php    ?>    
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