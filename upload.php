<?php

    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    include_once 'includes/profile_checker.php';
    sec_session_start();
     $query_URL = $_POST['pic_form'];
     $query = "UPDATE profile_info SET picture=? WHERE user=?";
     $updatePoints = $mysqli->prepare($query);
     if($updatePoints){
       $updatePoints->bind_param('ss',$query_URL,$_SESSION["username"]);
       $updatePoints->execute();
       header('Location: ./profile');
    }else{
        header('Location: ./profile?err=error');
    }

?>