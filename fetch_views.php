<?php

$get_id2=$_GET['activities'];
$act_id2=new MongoDB\BSON\ObjectID("$get_id2");

$all_views=$db->views->findOne(array( 'Activity Id'=>$act_id2));



