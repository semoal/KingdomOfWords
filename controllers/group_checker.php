<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'profile_checker.php';
sec_session_start();

    $prep_stmt = 'SELECT g.idGrupos, g.nombre, g.picture FROM groups AS g INNER JOIN profile_info AS p ON g.idGrupos=p.idGroup WHERE p.user=?';
    $results = $mysqli->prepare($prep_stmt);
    $results->bind_param('s',$_SESSION["username"]);
    $results->execute();
    $results->store_result();
    $results->bind_result($idGroups,$nombreGrupo,$pictureGrupo);
    $results->fetch();
    $_SESSION['nombreGrupo'] = $nombreGrupo;

    $queryTotalPreguntas="SELECT * FROM questions";
    $results=$mysqli->query($queryTotalPreguntas);
    $totalPreguntas=$results->num_rows;
    
    $queryIdGroup="SELECT idGroup FROM profile_info WHERE user='".$_SESSION["username"]."'";
    $results=$mysqli->query($queryIdGroup);
    $idGroup=$results->fetch_array();
    $idGroup=$idGroup[0];
    
    //Comprobamos los miembros del reino
    if($idGroup != NULL){
        $queryCantidadMiembros="SELECT * FROM profile_info WHERE idGroup='".$idGroup."'";
        $results=$mysqli->query($queryCantidadMiembros);
        $totalMiembros=$results->num_rows;
    }
    
    if($idGroup != null){
         $prep_stmt = 'SELECT * FROM  profile_info AS p INNER JOIN groups AS g ON g.idGrupos=p.idGroup WHERE p.idGroup="'.$idGroup.'"';
            $results=$mysqli->query($prep_stmt);
            $numMembers=$results->num_rows;
        while($result=$results->fetch_assoc()){
            $gPregCont+=$result["answers"];
            $gPregCorr+=$result["gooAns"];
        }
    }
    
    //Metodo que nos permite conocer las preguntas restantes del grupo
    if($gPregCorr>$totalPreguntas){
        $preguntasRestantes = 0;
    }else {
        $preguntasRestantes = $totalPreguntas-$gPregCorr;
    }
    
    if($gPregCont!=0 || $gPregCorr!=0){
        $correctas=($gPregCorr*100)/$gPregCont;
        $totalPreguntas=$totalPreguntas*$numMembers;
        $contestadas=($gPregCont*100)/$totalPreguntas;
        if($contestadas>100){
            $contestadas=100;
        }
        if($correctas>100){
            $correctas=100;
        }
    }
?>