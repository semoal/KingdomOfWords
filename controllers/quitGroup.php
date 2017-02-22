<?php
    /*
    * Página que nos permite eliminar al usuario de un grupo 
    */
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start;
    if(isset($_SESSION['username'])){
        $prep_stmt = "update profile_info set idGroup=null WHERE user = ? ";
        $stmt = $mysqli->prepare($prep_stmt);
        if ($stmt) {
            $stmt->bind_param('s', $_SESSION['username']);
            $stmt->execute();
            header('Location: ../views/kingdom');
            exit();
        } else {
            $error_msg .= '<p class="error">Error lo siento, lo repararemos pronto</p>';
        }
    }

?>