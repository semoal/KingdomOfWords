<?php
    include_once 'random_number.php';
    include_once 'db_connect.php';
    include_once 'functions.php';
    include_once 'profile_checker.php';
    sec_session_start();
    if($_SESSION["life"]>0){
        randomNumber();
        $_SESSION["ans"]='false';
        $_SESSION["ansQuestions"]= array();
        $_SESSION["combo"]=100;
        unset($_SESSION["random"]);
        unset($_SESSION["categoriaUsuario"]);
        header('Location: ../views/opcionUsuario');
    }else{
        header('Location: ./profile?err=No tienes vidas, cómprate una');
    }
?>