<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['user_or_email'], $_POST['p'])) {
    $user_or_email = filter_input(INPUT_POST, 'user_or_email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['p']; // The hashed password.
    
    if (login($user_or_email, $password, $mysqli) == true) {
        //Comprobar si el usuario está validado
        if(check_validate($user_or_email,$mysqli)){
            header("Location: ../views/profile");
            exit();
        }else{
            header('Location: ../controllers/logout');
            
            exit();
        }
        // Login success 
        
    } else {
        // Login failed 
        header('Location: ../index?error=1');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: ../error?err=Could not process login');
    exit();
}