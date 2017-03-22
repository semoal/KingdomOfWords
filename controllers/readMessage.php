<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'chatController.php';
    sec_session_start();
    $reader = new chatController();
    
    
    $idEmisor = $reader->getId($_REQUEST["user"]);
    $id = $reader->idEmisor;
    echo "receptor = ".$idEmisor;
        echo "emisor".$id;

    sec_session_start();
    
    $query = "UPDATE chat SET read_receptor=1 WHERE idReceptor=? AND idEmisor=?";
    $updateRead = $mysqli->prepare($query);
    if($updateRead){
        $updateRead->bind_param('ii',$id,$idEmisor);
        $updateRead->execute();
    }
    
?>