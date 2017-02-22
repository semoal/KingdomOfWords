<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start;
    
	$prep_stmt = 'SELECT idGrupos,password,salt FROM groups WHERE nombre = ?';
    $results = $mysqli->prepare($prep_stmt);
    $results->bind_param('s',$_POST["user_group"]);
    $results->execute();
    $results->store_result();
    $results->bind_result($idGrupos,$password,$salt);
    $results->fetch();
    
    $_POST["password_group"] = hash('sha512', $_POST["password_group"] . $salt);
    
    
    
    if($_POST["password_group"] != $password){
    	header("Location: ../views/kingdom?err=Contraseña erronea");
    	
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