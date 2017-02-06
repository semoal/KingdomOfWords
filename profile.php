<?php 
   
   include_once 'includes/db_connect.php';
   include_once 'includes/psl-config.php';
   include_once 'includes/functions.php';
   sec_session_start();
   $prep_stmt = 'SELECT points, picture, gooAns, answers, level FROM profile_info WHERE user=?';
   $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) {
        $stmt->bind_param('s', $_SESSION["username"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($points, $picture, $goodAns, $answers, $level);
        $stmt->fetch();
   }
   //Subimos el nivel del usuario cuando los puntos llegan a 1000
   if($points>=1000){
      $level++;
      $points -= 1000;
      //Insertamos el nivel en la bd 
      $query = "UPDATE profile_info SET level='$level' WHERE user=?";
      $updateLevel = $mysqli->prepare($query);
      
      if($updateLevel){
         $updateLevel->bind_param('s', $_SESSION["username"]);
         $updateLevel->execute();
      }
      //Reseteamos los puntos para el siguiente nivel
      $query2 = "UPDATE profile_info SET points='$points' WHERE user=?";
      $updatePoints = $mysqli->prepare($query2);
      
      if($updatePoints){
         $updatePoints->bind_param('s', $_SESSION["username"]);
         $updatePoints->execute();
      }
   }
   //Query para coger las ultimas dos preguntas
   $queryQuestions = 'SELECT lastQuestion, lastQuestion2 FROM profile_info WHERE user=?';
   $lastQuestions = $mysqli->prepare($queryQuestions);
    
    if ($lastQuestions) {
        $lastQuestions->bind_param('s', $_SESSION["username"]);
        $lastQuestions->execute();
        $lastQuestions->store_result();
        $lastQuestions->bind_result($question1,$question2);
        $lastQuestions->fetch();
   }
   
   $queryQuestions = 'SELECT tittle FROM questions WHERE idQuestion=?';
   $lastQuestions = $mysqli->prepare($queryQuestions);
    
    if ($lastQuestions) {
        $lastQuestions->bind_param('i', $question1);
        $lastQuestions->execute();
        $lastQuestions->store_result();
        $lastQuestions->bind_result($lastQuestion1);
        $lastQuestions->fetch();
   }
   
   $queryQuestions = 'SELECT tittle FROM questions WHERE idQuestion=?';
   $lastQuestions = $mysqli->prepare($queryQuestions);
    
    if ($lastQuestions) {
        $lastQuestions->bind_param('i', $question2);
        $lastQuestions->execute();
        $lastQuestions->store_result();
        $lastQuestions->bind_result($lastQuestion2);
        $lastQuestions->fetch();
   }
   
   $optionQuestion1 = explode('.',$question1);
   $optionQuestion2 = explode('.',$question2);

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS --> 
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/profile.css">
      <link rel="stylesheet" type="text/css" href="styles/style.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <?php if (login_check($mysqli) == true) : ?>
      <title>Bienvenido <?php echo htmlentities($_SESSION['username']); ?></title>
   </head>
   <body>
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a class="navbar-brand" href="profile.php">Kingdom of Words</a>
            </div>
            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                  <a href="profile.php">
                  <span class="menu-icon fa fa-user"></span>
                  <?php echo $_SESSION["username"] ?>
                  </a>
               </li>
               <li>
                  <a href="new_play.php">
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
                  <a href="#">
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
                  <a href="includes/logout.php">
                  <span class="menu-icon fa fa-sign-out" aria-hidden="true">
                  </span>
                  Salir
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Diselo perfil --> 
      <div class="container target">
      <div class="row">
          <div class="col-sm-2">
             <a class="pull-left">
                 <label class="label label-success label-level"><?php echo $level ?> </label>
                 <img title="profile image" width="150px" height="150px" class="img-circle img-responsive" src="<?php echo $picture?>">
             </a>
         </div>
         <div class="col-sm-10">
            <h1><?php echo htmlentities($_SESSION['username']); ?> </h1>
            <div class="progress">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow=""
              aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $points/10 ?>%">
               <?php echo $points?> puntos
              </div>
            </div>
          <!--Cuenta los puntos para subir de nivel --> 
           <label class="label-points label-success"> 
              <?php 
              $calculo = (1000-$points);
              echo "Te quedan ".$calculo." puntos para subir de nivel";
              ?>
           </label>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-sm-3">
            <!-- col izq-->
            <ul class="list-group">
               <li class="list-group-item text-muted" contenteditable="false">Perfil</li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Preguntas contestadas</strong></span> <?php echo $answers?></li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Preguntas correctas: </strong></span> <?php echo $goodAns?></li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Porcentaje de acierto: </strong></span>
               <?php 
               if($goodAns!=null || $answers!=null) {
                  echo round($goodAns/$answers*100,2)."%";
               }else {
                  echo "A jugar";
               }
               ?>
               </li>
              <!-- <li class="list-group-item text-right"><span class="pull-left"><strong class="">Consejo en: </strong></span> 7 horas y 12 minutos -->
               </li>
            </ul>
         </div>
         <!--col medio-->
         <div class="col-sm-9" contenteditable="false" style="">
            <div class="panel panel-default">
               <div class="panel-heading">Tus ultimas preguntas contestadas</div>
                <div class="list-group">
                    <a class="list-group-item">
                       <?php
                        if($optionQuestion1[1]=="correct"){
                           echo '<span style="float:right;" class="label label-success label-right">✓</span>';
                        }else {
                          echo '<span style="float:right;" class="label label-danger label-right">X</span>';
                        }
                        ?>
                      <h4 class="list-group-item-heading">
                      <?php 
                        echo utf8_encode($lastQuestion1);
                      ?>    
                      </h4>
                      <p class="list-group-item-text"> 
                        - <?php echo $optionQuestion1[2] ?>
                      </p>
                    </a>
                    <a class="list-group-item">
                     <?php 
                      if($optionQuestion2[1]=='correct'){
                           echo '<span style="float:right;" class="label label-success label-right">✓</span>';
                        }else {
                          echo '<span style="float:right;" class="label label-danger label-right">X</span>';
                      }
                     ?>
                      <h4 class="list-group-item-heading">
                      <?php
                        echo utf8_encode($lastQuestion2);
                      ?>
                      </h4>
                      <p class="list-group-item-text">
                        - <?php echo $optionQuestion2[2] ?>
                      </p>
                    </a>
                </div>
            </div>
        <!-- Segunda col medio -->
            <div class="panel panel-default target">
               <div class="panel-heading" contenteditable="false">Desbloquea preguntas</div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="thumbnail disabled">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre.png">
                           <div class="caption">
                              <h3 style="text-align:center;">
                                 100 preguntas
                              </h3>
                              <p align=center>
                                 <button class="btn btn-warning disabled"> Desbloquea </button> 
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre2.png">
                           <div class="caption">
                              <h3 style="text-align:center;">
                                 250 preguntas
                              </h3>
                              <p align=center>
                                 <button class="btn btn-warning disabled"> Desbloquea </button> 
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre5.png">
                           <div class="caption">
                               <h3 style="text-align:center;">
                                 500 preguntas
                              </h3>
                              <p align=center>
                                 <button class="btn btn-warning disabled"> Desbloquea </button> 
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php else : ?>
      <p>
         <span class="error">No estas autorizado para entrar en este apartado</span> Por favor <a href="index.php">inicia sesión</a>.
      </p>
      <?php endif; ?>
   </body>
</html>