<?php
    include_once 'includes/random_number.php';
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    include_once 'includes/profile_checker.php';
    sec_session_start();
    if($_SESSION["life"]>0){
        randomNumber();
        $_SESSION["ans"]='false';
        $_SESSION["ansQuestions"]= array();
        $_SESSION["combo"]=100;
        unset($_SESSION["random"]);
        unset($_SESSION["categoriaUsuario"]);
        header('Location: ./opcionUsuario');
    }else{
        header('Location: ./profile?err=No tienes vidas, cómprate una');
    }
?>