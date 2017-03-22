<?php 
   
    include_once '../controllers/db_connect.php';
    include_once '../controllers/functions.php';
    include_once '../controllers/chatController.php';
    $chatController = new chatController();
    $chatController->getMessages();
    
    function getNombre($idUser){
        global $mysqli;
            $query = "SELECT user FROM profile_info WHERE idProfile = ?";
            if($stmt = $mysqli->prepare($query)){
                $stmt->bind_param('i',$idUser);
                
                $stmt->execute();
                $stmt->bind_result($user);
                $stmt->fetch();
                
                return $user;
            }
    }
    
    function getFoto($user){
        global $mysqli;
            $query = "SELECT picture FROM profile_info WHERE user = ?";
            if($stmt = $mysqli->prepare($query)){
                $stmt->bind_param('s',$user);
                
                $stmt->execute();
                $stmt->bind_result($picture);
                $stmt->fetch();
                
                return $picture;
            }
    }
   
    sec_session_start();
            $user=$_REQUEST["user"];
            $chats=array();
            $me=getNombre($chatController->idEmisor);
            $i=0;
            
            if(!empty($chatController->messages)){
                foreach($chatController->messages as $message){
                    
                    $temp=$message;
                    $temp[1]=getNombre($temp[1]);
                    $temp[0]=getNombre($temp[0]);
                    
                    if($temp[0]==$user || $temp[1]==$user){
                        
                       $chats[0][$i]=$temp;
                       
                       $i++;
                    }
                }
            }
?>

    
<?php 
    foreach($chats as $chat){
        for($i = 1; $i<count($chat); $i++){
            $message=$chat[$i];
            
            if($message[0]==$_SESSION["username"]){
                $userPos='message-personal ';
            }else{
                $userPos=false;
            }
?>
    


            
                   <div class="message <?php echo $userPos?>new">
                      
                        <?php
                            if($message[0]!=$_SESSION["username"]){
                        ?>
                                <figure class="avatar">
                                <img src="<?php echo getFoto($message[0]) ?>">
                                </figure>
                        <?php
                        }
                       
                       $url = $message[2];
                       $url = filter_var($url, FILTER_SANITIZE_URL);
                        if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                           if(is_array(getimagesize($message[2]))){
                               ?>
                                <img style="max-width:300px;max-height:300px;" src="<?php echo $message[2] ?>">
                               <?php
                           }else if(!is_array(getimagesize($message[2]))){
                               ?>
                               <a href="<?php echo $message[2] ?>"> <?php echo $message[2] ?> </a>
                               <?php
                           }
                        } else {
                            echo $message[2];
                        }
                                                    
                      ?>
                      <div class="timestamp"> 
                          <?php 
                          $date = date_create($message[3]);
                          echo date_format($date->modify('+1 hour'), 'g:i'); ?>
                      </div>
                   </div>
<?php
        
    }

    }
?>






