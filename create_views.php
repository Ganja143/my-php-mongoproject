<?php

$get_id=$_GET['activities'];
$user=$_SESSION['user'];
$act_id=new MongoDB\BSON\ObjectID("$get_id");
$userId=new MongoDB\BSON\ObjectID("$user");
$views=0;
$dataUser=$db->views->findOne(array('User Id'=>$userid));
$dats=$db->views->findOne(array('Activity Id'=>$act_id));

if($dataUser && $dataUser['Views']>0 && $dats){

    header("Location:public.php") ;

 }else{

$dats=$db->views->findOne(array('Activity Id'=>$act_id));

if($userId != $dats['User Id'] ){



    $views=$dats['Views']+1;
    $setView=$db->views->insertOne(array(
     
        'User Id'=>$userId,
        'Activity Id'=>$act_id,
        'Views'=>$views
    ));
   }
}


