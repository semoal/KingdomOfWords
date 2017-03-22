<?php 
     include_once 'db_connect.php';
     include_once 'functions.php';
     sec_session_start();
    //Creamos un js/chatFunctions.js  que contenga las peticiones de AJAX
    // El mensaje tendrá que tener una sintaxis tipo: kiatoski-Hola que tal el viaje.
    class chatController{
        public $message;
        public $idEmisor;
        public $idReceptor;
        public $nombreEmisor;
        public $messages;
        
        
        public function __construct(){
            global $mysqli;
            $this->getEmisor();
            $this->checkMessage();
        }
        
        public function checkMessage(){
            if(isset($_REQUEST["message"])){
                
                
                $this->getReceptor($_REQUEST["user"]);
                
                $this->message=$_REQUEST["message"];
               
                
            }
        }
        
        public function getEmisor(){
            global $mysqli;
                $query = "SELECT idProfile FROM profile_info WHERE user = ?";
                $stmt = $mysqli->prepare($query);
                if($stmt){
                    $stmt->bind_param('s',$_SESSION["username"]);
                    $stmt->execute();
                    $stmt->bind_result($idEmisor);
                    $stmt->fetch();
                    $this->idEmisor=$idEmisor;
                    
                }
        }
        
        public function getReceptor($receptor){
            global $mysqli;
            $query = "SELECT idProfile FROM profile_info WHERE user = ?";
            if($stmt = $mysqli->prepare($query)){
                $stmt->bind_param('s',$receptor);
                $stmt->execute();
                $stmt->bind_result($idReceptor);
                $stmt->fetch();
                $this->idReceptor=$idReceptor;
            }
            
        }
        
        public function setMessage(){
            global $mysqli;
            $query = "INSERT INTO chat (idEmisor,idReceptor,message,time,read_receptor) VALUES (?,?,?,NOW()+1,0)";
            if($stmt = $mysqli->prepare($query)){
                $stmt->bind_param('iis',$this->idEmisor,$this->idReceptor,$this->message);
                $stmt->execute();
                $this->message="";
            }else{
                $err;
            }
        }
       
        function getId($user){
            global $mysqli;
            $query = "SELECT idProfile FROM profile_info WHERE user = ?";
            $updateRead = $mysqli->prepare($query);
            if($updateRead){
                $updateRead->bind_param('s',$user);
                $updateRead->execute();
                $updateRead->bind_result($idEmisor);
                $updateRead->fetch();
                return $idEmisor;
            }
        }
        
        public function getMessages(){
            global $mysqli;
            $query = "SELECT c.idReceptor, c.idEmisor, c.message, c.time FROM chat AS c INNER JOIN profile_info AS p ON c.idEmisor = p.idProfile WHERE c.idReceptor = ? OR c.idEmisor = ? AND c.idReceptor != 0 ORDER BY c.time ASC";

            if($stmt = $mysqli->prepare($query)){
                
                $stmt->bind_param('ii',$this->idEmisor,$this->idEmisor);
                $stmt->execute();
                $stmt->bind_result($idReceptor,$idEmisor,$message,$time);
                $i=0;
                while($stmt->fetch()){
                       $timeMinutes = substr($time,strlen($time)-8,5);
                       $this->messages[$i]=array($idEmisor,$idReceptor,utf8_encode($message),$timeMinutes);
                       $i++;
                }
            
        }
    }
}
   
?>