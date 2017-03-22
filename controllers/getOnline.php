<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'chatController.php';
    $chatController = new chatController();
    
    sec_session_start();
    function numMessages($emisor,$receptor){
        global $mysqli;
            $query = "SELECT COUNT(idMessage) FROM chat WHERE idEmisor=? AND idReceptor=? AND read_receptor=0";
            $updateRead = $mysqli->prepare($query);
            if($updateRead){
                $updateRead->bind_param('ii',$emisor,$receptor);
                $updateRead->execute();
                $updateRead->bind_result($mensajesRecibidos);
                $updateRead->fetch();
                return $mensajesRecibidos;
            }
    }
    
    $userId = $_SESSION['user_id'];
    if($userId){
        $query = "UPDATE members SET online = NOW() WHERE id = ?";
        if($stmt = $mysqli->prepare($query)){
            $stmt->bind_param('i',$userId);
            $stmt->execute();
        }
    }
    
    $online=array();
    $onlineCurrent = array();
    $today = date('Y-m-d');
    $output = "<div class='list-group'>"; 
    $query = ("select username,online from members where online > NOW() - INTERVAL 1 MINUTE");
    if ($result = mysqli_query($mysqli, $query)) {
        $i=0;
        while ($row = $result->fetch_assoc()) {
            $online[$i]= $row["username"];
            $i++;
        }
    }
    $query = ("select online from members");
    if ($result = mysqli_query($mysqli, $query)) {
        $z=0;
        while ($row = $result->fetch_assoc()) {
            $onlineCurrent[$z] = date_create($row["online"]);
            $z++;
        }
    }
    $query = ("select user, picture, idProfile from profile_info where user not like '".$_SESSION["username"]."'");
    if($result = mysqli_query($mysqli, $query)){
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            
            $numMessages=numMessages($row["idProfile"],$chatController->idEmisor);
            
            if(in_array($row["user"], $online)){
                $status ="En linea";
            }else{
                if(date_format($onlineCurrent[$i],'Y-m-d') < $today){
                    $status = "Última conexión: ".date_format($onlineCurrent[$i], 'd/m/y H:i:s');
                }else{
                    $status = "Última conexión: ".date_format($onlineCurrent[$i], 'g:i A');
                }
            }
                if($numMessages == 0){
                    $output .= '<div class="chat-title chat-onlineusers"><h1>'.$row["user"].'</h1><h2>'.$status.'</h2>'.'<figure class="avatar">
                    <img src='.$row["picture"].' /></figure>
                    </div>';
                }else{
                    $output .= '<div class="chat-title chat-onlineusers"><h1>'.$row["user"].'</h1><span style="background-color:red;width:20px;font-size:10px;" class="badge badge-pill badge-danger pull-right">'.$numMessages.'</span> <h2>'.$status.'</h2>'.'<figure class="avatar">
            <img src='.$row["picture"].' /></figure>
       </div>';
                }
            
                    $i++;

        }
        $output .="</div>";
    }
    print $output;
?>
<style type="text/css" src="../styles/chat.css">
    
</style>