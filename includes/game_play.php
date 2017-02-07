<?php 
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
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
                
                if($updatePoints){
                   $updatePoints->bind_param('is',$points=100,$_SESSION["username"]);
                   $updatePoints->execute();
                   
                  
                }
                 echo '<script type="text/javascript">
                            window.onload = function(){
                            goodAnswer();
                            }
                        </script>';
            }else{
                //PREGUNTA INCORRECTA DENTRO DEL IF
                 $this->correct=$this->idQuestion.'.incorrect'.'.'.$aAnswer;
                 echo '<script type="text/javascript">
                            window.onload = function(){
                            badAnswer();
                            }
                        </script>';
            }
                //PREGUNTA INCORRECTA FUERA DEL IF
                
                $query = "UPDATE profile_info SET answers=answers+? WHERE user=?";
                $updateAnswers = $mysqli->prepare($query);
                
                if($updateAnswers){
                   $updateAnswers->bind_param('is',$answers=1,$_SESSION["username"]);
                   $updateAnswers->execute();
                }
                
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
                
        }
        
        public function checkAnswerStyle($idAnswer){
            if(isset($_GET["a"])){
                if($idAnswer==$this->rightAnswer){
                    echo 'rightAnswer'; 
                }else{
                    echo 'badAnswer';
                }
            }
            if($_SESSION["ans"]=='true'){
                echo ' disabled';
            }
        }
        
        public function changeAns(){
        
            if($_SESSION["ans"]=='true'){
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
        
    }

?>