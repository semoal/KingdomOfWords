<?php
    include_once 'includes/random_number.php';
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    sec_session_start();
    randomNumber();
    $_SESSION["ans"]='false';
    $_SESSION["ansQuestions"]= array();
    unset($_SESSION["random"]);
    unset($_SESSION["categoriaUsuario"]);
    header('Location: ./opcionUsuario');
?>