<?php

    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start();
     $query_URL = $_POST['pic_form'];
     if(is_array(getimagesize($query_URL))){
         $query = "UPDATE profile_info SET picture=? WHERE user=?";
         $updatePoints = $mysqli->prepare($query);
         if($updatePoints){
           $updatePoints->bind_param('ss',$query_URL,$_SESSION["username"]);
           $updatePoints->execute();
           header('Location: ../views/profile');
        }else{
            header('Location: ../views/profile?err=Error');
        }
     }else{
         header('Location: ../views/profile?err=Url de imagen no valida');
     }
     
?>