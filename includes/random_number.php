<?php
   include_once 'db_connect.php';
   include_once 'functions.php';
   sec_session_start();
   function randomNumber(){
        if(!isset($_SESSION["ansQuestions"])){
            $_SESSION["ansQuestions"]= array();
        }
        $queNum=6;
        if(count($_SESSION["ansQuestions"])!=$queNum){
            $random = rand(1,$queNum);
            
            while(in_array($random,$_SESSION["ansQuestions"])){
                $random = rand(1,6);
            }
            
            array_push($_SESSION["ansQuestions"],$random);
            
        }else{
            $random=false;
        }
        $_SESSION["random"]=$random;
   }
  ?>
   