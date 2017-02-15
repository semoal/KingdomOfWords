<?php 
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    include_once 'includes/profile_checker.php';
    /**
     * Clase que se llamará cada vez que se juega
     */
    
     
    class Play
    {
        public $tittle;
        public $answer;
        public $answers;
        public $rightAnswer;
        public $category;
        public $idQuestion;
        public $correct;
        public $points;

        /**
         * Al construct le pasaremos la query que contenga las preguntas y sacaremos de ahi cada elemento
         */
        
        public function __construct($result)
        {
            $this->idQuestion=$result["idQuestion"];
            $this->tittle=utf8_encode($result["tittle"]);
            $this->answer=utf8_encode($result["answers"]);
            $this->answers=explode('-',$this->answer);
            sort($this->answers);
            $this->rightAnswer=utf8_encode($result["rightAnswer"]);
            $this->category= utf8_encode($result["category"]);  
        }
        
        public function checkAnswer($aAnswer){
            global $mysqli;
            if($aAnswer==$this->rightAnswer){
                //PREGUNTA CORRECTA
                $this->correct=$this->idQuestion.'.correct'.'.'.$aAnswer;
                //query para actualizar numero de preguntas acertadas
                $query = "UPDATE profile_info SET gooAns=gooAns+? WHERE user=?";
                $updateGoodAns = $mysqli->prepare($query);
                
                if($updateGoodAns){
                   $updateGoodAns->bind_param('is',$goodAns=1,$_SESSION["username"]);
                   $updateGoodAns->execute();
                }
                
                //query para actualizar los puntos por cada pregunta acertada
                $query = "UPDATE profile_info SET points=points+? WHERE user=?";
                $updatePoints = $mysqli->prepare($query);
                $this->points=$_SESSION["combo"];
                
                if($updatePoints){
                   $updatePoints->bind_param('is',$this->points,$_SESSION["username"]);
                   $updatePoints->execute();
                   
                 $_SESSION["combo"]=$_SESSION["combo"]+100; 
                }
                $_SESSION['erroneas'] = 0;
                echo '<script type="text/javascript">
                            window.onload = function(){
                            goodAnswer();
                            }
                        </script>';
            }else{
                //PREGUNTA INCORRECTA DENTRO DEL IF
                $_SESSION["combo"]=100;
                $query = "UPDATE profile_info SET answers=answers+?, points=points-? WHERE user=?";
                $updateAnswers = $mysqli->prepare($query);
                $points=50;
                if($updateAnswers){
                   $updateAnswers->bind_param('iis',$answers=1,$points,$_SESSION["username"]);
                   $updateAnswers->execute();
                }
                
                if($aAnswer=='timer-out'){
                    $aAnswer='Fuera de tiempo';
                }
                 $this->correct=$this->idQuestion.'.incorrect'.'.'.$aAnswer;
                 if($aAnswer=="timer-out"){
                     $_SESSION['erroneas']++;
                     echo '<script type="text/javascript">
                            window.onload = function(){
                            timerOut();
                            }
                        </script>';
                 }else{
                     $_SESSION['erroneas']++;
                     echo '<script type="text/javascript">
                            window.onload = function(){
                            badAnswer();
                            }
                        </script>';
                 }
                 
            }
                //PREGUNTA INCORRECTA FUERA DEL IF
                
                
                $query = "UPDATE profile_info SET lastQuestion2=lastQuestion WHERE user=?";
                $updateLastQuestion2 = $mysqli->prepare($query);
                
                if($updateLastQuestion2){
                   $updateLastQuestion2->bind_param('s',$_SESSION["username"]);
                   $updateLastQuestion2->execute();
                }
                
                $query = "UPDATE profile_info SET lastQuestion=? WHERE user=?";
                $updateLastQuestion = $mysqli->prepare($query);
                
                if($updateLastQuestion){
                    $updateLastQuestion->bind_param('ss',$this->correct,$_SESSION["username"]);
                   $updateLastQuestion->execute();
                }
                if($_SESSION['erroneas']==3){
                    $query = "UPDATE profile_info SET life=life-? WHERE user=?";
                    $updateLife = $mysqli->prepare($query);
                    if($updateLife){
                       $updateLife->bind_param('is',$life=1,$_SESSION["username"]);
                       $updateLife->execute();
                       $_SESSION['erroneas'] = 0;
                    }
                }
                
        }
        
        public function checkAnswerStyle($idAnswer){
            if(isset($_GET["a"])){
                if($idAnswer==$this->rightAnswer){
                    echo 'rightAnswer disabled'; 
                }else{
                    echo 'badAnswer';
                }
            }
            
        }
        
        public function changeAns(){
        
            if(isset($_GET["a"])){
                $_SESSION["ans"]='false';
                
             }else{
                $_SESSION["ans"]='true';
             }
        }
        
        public function nextQuestionButton(){
            if($_SESSION["ans"]=='true'){
                echo '<a href="?" class="btn btn-blueword btn-preguntas">Siguiente pregunta</a>';
            }
        }
        
        public function checkTimer(){
            if(!isset($_GET["a"])){
                echo 'timer();';
            }
        }
    }

?>