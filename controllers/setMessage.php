<?php 
   
    include_once '../controllers/db_connect.php';
    include_once '../controllers/functions.php';
    include_once '../controllers/chatController.php';
    sec_session_start();
    $chatController = new chatController();
    $chatController->setMessage();
?>

<?php 
            
        