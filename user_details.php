<?php

if(!isset($_SESSION['user'])){
    header("Login.php");
}

$user=$_SESSION['user'];

$user_data=$db->users->findOne(array('_id'=>$user));

if($user_data){

    $name=$user_data['name'];
    $surname=$user_data['surname'];
    $user_mail=$user_data['Username'];
    $propic=$user_data['profile'];
}