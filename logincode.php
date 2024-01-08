<?php
require_once('config.php');

$mail=isset($_POST['username'])? $_POST['username'] :"";  
$pass=isset($_POST['password'])? $_POST['password'] :"";

$pass=hash('sha256',$pass);

if(isset($_POST['btn_login'])){

  

    $result=$db->users->findOne(array('Username'=>$mail, 'password'=>$pass));
    
     if($result)
     {
        $_SESSION['user']=$result->_id;

     }else{
        echo 'Invalid inputs';
     }  
}

?>