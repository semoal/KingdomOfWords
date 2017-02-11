<?php
   include_once 'db_connect.php';
   include_once 'functions.php';
   sec_session_start();
    
    
    $prep_questions = 'SELECT questions FROM repQuestions WHERE username=?';
    $questionStmt = $mysqli->prepare($prep_questions);
    $questionStmt->bind_param('s',$_SESSION["username"]);
    $questionStmt->execute();
    $questionStmt->store_result();
    $questionStmt->bind_result($questions);
    $questionStmt->fetch();
    $questionArray=explode(',',$questions);
    for ($i = 0; $i < count($questionArray); $i++) {
         $questionArray[$i]=intval($questionArray[$i]);
    }
    
   function randomNumber($category){
        global $mysqli;
        global $questions;
        global $questionArray;
        if(!isset($_SESSION["ansQuestions"])){
            $_SESSION["ansQuestions"]= array();
        }
        
        if($category!="none"){
            $prep_stmt = "SELECT idQuestion FROM questions WHERE category='$category'";
            $results = $mysqli->query($prep_stmt);
                        
            for ($i = 0; $i < $results->num_rows; $i++) {
                $result=$results->fetch_assoc();
                $idArray[$i]=intval($result["idQuestion"]);
            } 
            $maxId=count($idArray);
            
            if(count($_SESSION["ansQuestions"]) != $maxId){
                $i = array_rand($idArray);
                $random=$idArray[$i];
                while(in_array($random,$_SESSION["ansQuestions"])){
                    $i = array_rand($idArray);
                    $random=$idArray[$i];
                }
                
                array_push($_SESSION["ansQuestions"],$random);
                $questions=$questions.','.$random;
                $prep_insert_questions = "UPDATE repQuestions SET questions=? where username=?";
                $results = $mysqli->prepare($prep_insert_questions);
                $results->bind_param('ss',$questions,$_SESSION["username"]);
                $results->execute();
                }else{
                    $random=false;
                }
            
        }else{
            $prep_stmt = 'SELECT MAX(idQuestion) as maxId FROM questions';
            $results = $mysqli->prepare($prep_stmt);
            $results->execute();
            $results->store_result();
            $results->bind_result($maxId);
            $results->fetch();
        
            
            
            if(count($_SESSION["ansQuestions"]) != $maxId){
                
                $random = rand(1,$maxId);
                if(count($questionArray)<=$maxId){
                while(in_array($random,$questionArray)){
                    $random = rand(1,$maxId);
                }
                
                array_push($_SESSION["ansQuestions"],$random);
                $questions=$questions.','.$random;
                $prep_insert_questions = "UPDATE repQuestions SET questions=? where username=?";
                $results = $mysqli->prepare($prep_insert_questions);
                $results->bind_param('ss',$questions,$_SESSION["username"]);
                $results->execute();
                }else{
                    $random=false;
                }
            }else{
                $random=false;
            }
        }
        
        $_SESSION["random"]=$random;
        echo $_SESSION["random"].' ';
        
        
   }
   
?>
   