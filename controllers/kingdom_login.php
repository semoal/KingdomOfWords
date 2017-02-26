<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start;
    
    
    if(isset($_POST["user_group"])){
        $user_group = $_POST["user_group"];
    }else{
        $user_group=$_REQUEST["user_group"];
    }
    if(isset($_POST["password_group"])){
        $password_group=$_POST["password_group"];
    }else{
        $password_group="";
    }
    $prep_stmt = 'SELECT idGrupos,password,salt FROM groups WHERE nombre = ?';
    $results = $mysqli->prepare($prep_stmt);
    $results->bind_param('s',$user_group);
    $results->execute();
    $results->store_result();
    $results->bind_result($idGrupos,$password,$salt);
    $results->fetch();
    
    $password_group = hash('sha512', $password_group . $salt);
    
    
    
    if($password_group != $password){
        header("Location: ../views/kingdom?err=Contraseña_erronea");

    }else{
        if(isset($idGrupos)){
                $query = "UPDATE profile_info SET idGroup=? WHERE user = ?";
                  $results = $mysqli->prepare($query);
                  
                  if($results){
                     $results->bind_param('is',$idGrupos, $_SESSION["username"]);
                     $results->execute();
                     header("Location: ../views/kingdom");
                  }
                
        }else{
            header("Location: ../views/kingdom.php?err=Datos incorrectos");
        }
    }

    
    
?>