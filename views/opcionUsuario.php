<?php
   include_once '../controllers/db_connect.php';
   include_once '../controllers/functions.php';
   sec_session_start();
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Meta charset --> 
      <meta charset="UTF-8">
      <meta name="theme-color" content="#1e2b3a" />
      <link rel="icon" type="image/png" href="../img/kingdomLogo.png">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../styles/style.css">
      <link rel="stylesheet" type="text/css" href="../styles/modal.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script type="text/javascript">
           $(window).load(function(){
            $('#showModal').modal('show');
            });
      </script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <title>Kingdom of Words</title>
   </head>
   <?php if(login_check($mysqli) == true) { ?>
   <body>
<div class="container">
   <div class="row">
      <div class="col-md-3 col-md-offset-3" style="text-align:center;">
         <div class="container-middle">
            <div class="col-md">
                    <div class="modal-dialog">
                    <div class="modal-content" id="showModal">
                        <div class="modal-header">
                            <h4 class="modal-title">Elige una categoria</h4>
                        </div>
                        <div class="modal-body"> 
                            <a href="questions?cat=Deportes"> <img src="http://preguntados.com/compiled/img/landing/character-bonzo.png"/> </a>
                            <a href="questions?cat=Historia"> <img src="http://preguntados.com/compiled/img/landing/character-hector.png"/></a>
                            <a href="questions?cat=CienciaTecnologia"> <img src="http://preguntados.com/compiled/img/landing/character-al.png"/></a>
                            <a href="questions?cat=ArteLiteratura"><img src="http://preguntados.com/compiled/img/landing/character-tina.png"/></a>
                            <a href="questions?cat=Geografia"><img src="http://preguntados.com/compiled/img/landing/character-tito.png"/></a>
                            <a href="questions?cat=Entretenimiento"><img src="http://preguntados.com/compiled/img/landing/character-pop.png"/></a><br>
                            <a href="questions?cat=none"> <button class="btn btn-md btn-login"> Cualquier pregunta </button> </a>
                        </div>    
                    </div>  
                </div> 
            </div>
        </div> 
   </div>
</div>
      <!-- Usuario no inicia sesión -->
      <?php 
      }else{
         echo "<h1> Es necesario que inicies sesión para entrar al apartado de opcion usuario. </h1>";
      }
      ?>
   </body>
</html>