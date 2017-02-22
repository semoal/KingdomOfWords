<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start();
     $query_URL = $_GET['pic_group'];
     $nombre = $_SESSION['nombreGrupo'];
     $query = "UPDATE groups SET picture=? WHERE nombre=?";
     $updateGroupImage = $mysqli->prepare($query);
     if($updateGroupImage){
       $updateGroupImage->bind_param('ss',$query_URL,$nombre);
       $updateGroupImage->execute();
       header('Location: ../views/kingdom');
    }else{
        header('Location: ../views/kingdom?err=error');
    }

?>