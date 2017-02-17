<?php 
include_once 'db_connect.php';
include_once 'functions.php';
sec_session_start();

$prep_stmt = 'SELECT points, picture, gooAns, answers, level, life FROM profile_info WHERE user=?';
   $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $_SESSION["username"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($points, $picture, $goodAns, $answers, $level, $life);
        $stmt->fetch();
   }
   $_SESSION["life"]=$life;
    $maxpoints=(pow($level*10,2)/20)*10;
    
   //Subimos el nivel del usuario cuando los puntos llegan a 1000
   if($points>=$maxpoints){
      $level++;
      $points -= 1000;
      //Insertamos el nivel en la bd 
      $query = "UPDATE profile_info SET level='$level' WHERE user=?";
      $updateLevel = $mysqli->prepare($query);
      
      if($updateLevel){
         $updateLevel->bind_param('s', $_SESSION["username"]);
         $updateLevel->execute();
      }
      //Reseteamos los puntos para el siguiente nivel
      $query2 = "UPDATE profile_info SET points='$points' WHERE user=?";
      $updatePoints = $mysqli->prepare($query2);
      
      if($updatePoints){
         $updatePoints->bind_param('s', $_SESSION["username"]);
         $updatePoints->execute();
      }
   }
   //Query para coger las ultimas dos preguntas
       $queryQuestions = 'SELECT lastQuestion, lastQuestion2 FROM profile_info WHERE user=?';
       $lastQuestions = $mysqli->prepare($queryQuestions);
        
        if ($lastQuestions) {
            $lastQuestions->bind_param('s', $_SESSION["username"]);
            $lastQuestions->execute();
            $lastQuestions->store_result();
            $lastQuestions->bind_result($question1,$question2);
            $lastQuestions->fetch();
       }
       
       $queryQuestions = 'SELECT tittle FROM questions WHERE idQuestion=?';
       $lastQuestions = $mysqli->prepare($queryQuestions);
        
        if ($lastQuestions) {
            $lastQuestions->bind_param('i', $question1);
            $lastQuestions->execute();
            $lastQuestions->store_result();
            $lastQuestions->bind_result($lastQuestion1);
            $lastQuestions->fetch();
       }
       
       $queryQuestions = 'SELECT tittle FROM questions WHERE idQuestion=?';
       $lastQuestions = $mysqli->prepare($queryQuestions);
        
        if ($lastQuestions) {
            $lastQuestions->bind_param('i', $question2);
            $lastQuestions->execute();
            $lastQuestions->store_result();
            $lastQuestions->bind_result($lastQuestion2);
            $lastQuestions->fetch();
       }
       $_SESSION['life'] = $life;
       $_SESSION['erroneas'] = $contadorErroneas;
       $optionQuestion1 = explode('.',$question1);
       $optionQuestion2 = explode('.',$question2);
    
    if($points<0){
          $points=0;
          $query = "UPDATE profile_info SET points='$points' WHERE user=?";
          $updatePoints = $mysqli->prepare($query);
          
          if($updatePoints){
             $updatePoints->bind_param('s', $_SESSION["username"]);
             $updatePoints->execute();
          }
        
    }
    
    if($life<0){
          $life=0;
          $query = "UPDATE profile_info SET life='$life' WHERE user=?";
          $updateLife = $mysqli->prepare($query);
          
          if($updateLife){
             $updateLife->bind_param('s', $_SESSION["username"]);
             $updateLife->execute();
          }
    }
    if($maxpoints>0){
        $prueba=$points*100/$maxpoints;
    }
?>