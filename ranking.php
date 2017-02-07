<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
   sec_session_start();
   $results = $mysqli->query('SELECT user, answers, gooAns, points,picture, level FROM profile_info');
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Meta charset --> 
      <meta charset="UTF-8">
      <meta name="google-signin-scope" content="profile email">
      <!-- <meta name="google-signin-client_id" content="831754447629-7n6vnv2klk5u88ekppbtt3dksk5jr2se.apps.googleusercontent.com">  -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- JavaScript -->
      <script type="text/JavaScript" src="js/sha512.js"></script> 
      <script type="text/JavaScript" src="js/forms.js"></script> 
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/modal.css">
      <link rel="stylesheet" type="text/css" href="styles/ranking.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <title>Kingdom of Words</title>
   </head>
   <?php if(login_check($mysqli) == true) { ?>
   <body>
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a class="navbar-brand" href="index?">Kingdom of Words</a>
            </div>
            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                  <a href="profile">
                  <span class="menu-icon fa fa-user"></span>
                  <?php echo $_SESSION["username"] ?>
                  </a>
               </li>
               <li>
                  <a href="new_play">
                  <span class="menu-icon fa fa-gamepad"></span>
                  Juega
                  </a>
               </li>
               <li>
                  <a href="#">
                  <span class="menu-icon fa fa-users" aria-hidden="true">
                  </span>
                  Grupos
                  </a>
               </li>
               <li>
                  <a href="ranking">
                  <span class="menu-icon fa fa-cloud-upload" aria-hidden="true">
                  </span>
                  Marcadores
                  </a>
               </li>
               <li>
                  <a href="#">
                  <span class="menu-icon fa fa-commenting" aria-hidden="true">
                  </span>
                  Chat
                  </a>
               </li>
               <li>
                  <a href="includes/logout">
                  <span class="menu-icon fa fa-sign-out" aria-hidden="true">
                  </span>
                  Salir
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Vista para usuario que no ha iniciado sesión --> 
      <div class="container target container-ranking">
         <div class="row">
            <div class="col-md-4 col-md-offset-4" style="text-align:center;">
               <div class="container-middle">
                 <?php 
                    while($result=$results->fetch_assoc()){ 
                 ?>
                   <div class="col-md panel panel-default">
                       <div class="panel-heading">
                           <img style="width:50px;height:50px;display:inline-flex;"title="profile image" class="img-circle img-responsive" src="<?php echo $result["picture"]?>">
                           Nombre: <?php echo $result["user"]?><br>
                       </div>
                        <div class="progress">
                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow=""
                          aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($result["gooAns"]/$result["answers"]*100,2); ?>%">
                           Precisión: <?php echo round($result["gooAns"]/$result["answers"]*100,2); ?>%
                          </div>
                        </div>
                       Respuestas: <?php echo $result["answers"]?><br>
                       Respuestas correctas: <?php echo $result["gooAns"]?><br>
                       Puntos: <?php echo $result["points"]?><br>
                       Nivel: <?php echo $result["level"]?>
                   </div>        
                 <?php 
                    } 
                 ?>
               </div>
            </div>
         </div>
      </div>
      <!-- Usuario no inicia sesión -->
      <?php 
      }else{
         echo "Es necesario que inicies sesión para entrar al apartado de rankings.";
      }
      ?>
      <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();   
      });
      </script>
   </body>
</html>