<?php 
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
   include_once 'includes/random_number.php';
   include_once 'includes/game_play.php';
   sec_session_start();
   // WORKAROUND COMO LA COPA DE UN PINO DE 8 METROS DE H
      $random=$_SESSION["random"];
      if($random!=false){
         $questions = "SELECT * FROM questions";
         $results = $mysqli->query($questions);
         
         foreach ($results as $result) {
            if($result["idQuestion"]==$random){
               $gamePlay=new Play($result);
            }
         }
      }
      if(isset($_GET["a"])){
         $gamePlay->checkAnswer($_GET["a"]);
      }
      
      
   function answered(){
      echo '<style type="text/css">
            .rightAnswer{
               color:green !important;
            }
            .badAnswer{
               color:red !important;
            }
            </style>
      ';
   }
   
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS --> 
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/profile.css">
      
      <link rel="stylesheet" type="text/css" href="styles/preguntas.css">
      <link rel="stylesheet" type="text/css" href="alerts/sweetalert.css">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="alerts/sweetalert.min.js"></script>

      
      <?php if (login_check($mysqli) == true){ ?>
         <?php if ($random!=false){ ?>
      <title>Bienvenido <?php echo htmlentities($_SESSION['username']); ?></title>
      <script type="text/javascript">
         function goodAnswer() {
            swal({
              title: "Bien hecho! +100",
              text: "Felicidades! Has ganado 100 puntos <br> Respuesta elegida: <?php echo $_GET['a']; ?>",
              type: "success",
              html: true,
              confirmButtonText: "Siguiente pregunta"
            },
            function(){
               window.location.href = '?';
            });
         }
         function badAnswer() {
           swal({
              title: "Oh.... -50",
              text: "Has fallado! <br> Respuesta elegida: <?php echo $_GET['a']; ?> <br> Respuesta correcta: <?php echo $gamePlay->rightAnswer; ?>",
              type: "error",
                html: true,
              confirmButtonText: "Siguiente pregunta"
            },
            function(){
               window.location.href = '?';
            }); 
         }
         function timerOut() {
            swal({
              title: "Oh.... -50",
              text: "Has tardado demasiado, a la proxima date prisa!!",
              type: "warning",
                html: true,
              confirmButtonText: "Siguiente pregunta"
            },
            function(){
               window.location.href = '?';
            }); 
         }
         var counter = 15;
         var interval = setInterval(function() {
          counter--;
          document.getElementById('clock').innerHTML = counter;
          if (counter == 0) {
              document.location.href="?a=timer-out";
              clearInterval(interval);
          }
         }, 1000);
      </script>
      <?php 
         if($_SESSION["ans"]=='true'){
            answered();
            randomNumber();
         }else{
            
         }
      ?>
   </head>
   <body>
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a class="navbar-brand" href="profile">Kingdom of Words</a>
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
      <!-- Diseño de las preguntas --> 
    <div id="container"> 
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="thumbnail">
              <!-- Label de la categoria de la pregunta -->
              <label style="position:absolute;margin:10px;" class="label label-success"> <?php echo $gamePlay->category ?></label>
              <!-- Timer de tiempo restante --> 
              <a id="clock" class="btn btn-default btn-circle pull-right"></a>
              <!-- Imagen de la pregunta --> 
              <img class="img-responsive img-rounded" src="http://tuportalpublicitario.com/wp-content/uploads/2014/08/mad-men.jpg">
              <div class="caption">
               <h1 class="h1-preguntas"><?php echo $gamePlay->tittle ?>  </h1> <br>
                <p>
                    <a href="?a=<?php echo $gamePlay->answers[0]?>" class="btn btn-blueword btn-preguntas <?php $gamePlay->checkAnswerStyle($gamePlay->answers[0]) ?>" role="button">
                       <?php echo $gamePlay->answers[0] ?>
                       </a>
                    <a href="?a=<?php echo $gamePlay->answers[1]?>" class="btn btn-blueword btn-preguntas <?php $gamePlay->checkAnswerStyle($gamePlay->answers[1]) ?>"  role="button">
                       <?php echo $gamePlay->answers[1] ?>
                       </a>
                    <a href="?a=<?php echo $gamePlay->answers[2]?>" class="btn btn-blueword btn-preguntas <?php $gamePlay->checkAnswerStyle($gamePlay->answers[2]) ?>"  role="button">
                       <?php echo $gamePlay->answers[2] ?>
                       </a>
                    <a href="?a=<?php echo $gamePlay->answers[3]?>" class="btn btn-blueword btn-preguntas <?php $gamePlay->checkAnswerStyle($gamePlay->answers[3]) ?>"  role="button">
                       <?php echo $gamePlay->answers[3] ?>
                       </a>
                    <?php $gamePlay->nextQuestionButton() ?>
                   <?php $gamePlay->changeAns() ?>
                </p>
              </div>
            </div>
          </div>
        </div>
    </div>
    
      <?php }else{  ?>
      <p>
         <?php
            unset($_SESSION["ansQuestions"]);
            unset($_SESSION["random"]);
            unset($_SESSION["ans"]);
            //Aquí hay 
            
         ?>
         <h1>Se han acabado las preguntas</h1> Por favor <a href="profile">vuelve a tu perfil, <?php echo $_SESSION["username"] ?></a>.
      </p>
      <?php }}else{ ?>
      <p>
         <span class="error">No estas autorizado para entrar en este apartado</span> Por favor <a href="index">inicia sesión</a>.
      </p>
      <?php } ?>
   </body>
</html>