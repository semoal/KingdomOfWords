<?php
   include_once 'db_connect.php';
   include_once 'functions.php';
   sec_session_start();
    $prep_stmt = 'SELECT MAX(idQuestion) as maxId FROM questions';
    $results = $mysqli->prepare($prep_stmt);
    $results->execute();
    $results->store_result();
    $results->bind_result($maxId);
    $results->fetch();
   function randomNumber(){
        global $maxId;
        if(!isset($_SESSION["ansQuestions"])){
            $_SESSION["ansQuestions"]= array();
        }
        if(count($_SESSION["ansQuestions"])!=$maxId){
            $random = rand(1,$maxId);
            
            while(in_array($random,$_SESSION["ansQuestions"])){
                $random = rand(1,$maxId);
            }
            
            array_push($_SESSION["ansQuestions"],$random);
            
        }else{
            $random=false;
        }
        $_SESSION["random"]=$random;
   }
  ?>
   