<?php 
   
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
   include_once 'includes/profile_checker.php';
   sec_session_start();
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="img/kingdomLogo.png">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- JavaScript -->
      <script type="text/JavaScript" src="js/sha512.js"></script> 
      <script type="text/JavaScript" src="js/forms.js"></script> 

      <!-- Google Login JS 
      <script src="https://apis.google.com/js/platform.js" async defer></script> -->
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/modal.css">
      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
      <?php if (login_check($mysqli) == true) : ?>
      <title>Bienvenido <?php echo htmlentities($_SESSION['username']); ?></title>
      <style type="text/css">
       .label-level {
           position: absolute;
           margin-left: 10px;
           font-size: 20px !important;
           padding: 10px;
        }
   </style>
        <link rel="stylesheet" type="text/css" href="styles/profile.css">
   </head>
   
   <body>
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a class="navbar-brand">
                  <img style="margin-top:-15px;" src="img/logo.png" width=150px alt="logo" class="img-thumbnail">
               </a>
            </div>
            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                  <a href="profile">
                  <span class="menu-icon fa fa-user"></span>
                  <span style="color:#ffcc00;"> <?php echo $_SESSION["username"] ?> </span>
                  </a>
               </li>
               <li>
                  <a href="new_play">
                  <span class="menu-icon fa fa-gamepad"></span>
                  Juega
                  </a>
               </li>
               <li>
                  <a href="kingdom">
                  <span class="menu-icon fa fa-users" aria-hidden="true">
                  </span>
                  Reinos
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
                  <a href="includes/logout">
                  <span class="menu-icon fa fa-sign-out" aria-hidden="true">
                  </span>
                  Salir
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Diselo perfil --> 
      <?php if(isset($_GET["err"])){ ?>
          <div>
              <h1 style="color:red"><?php echo $_GET["err"]?></h1>
          </div>
      <?php } ?>
      <div class="container target">
      <div class="row">
          <div class="col-sm-2">
             <a class="pull-left">
                 <img style="width:150px;height:150px;background-size:cover;max-width:150px;min-width:150px;max-height:150px;min-height:150px;"title="profile image" class="img-circle img-responsive img-logo-pic" src="<?php echo $picture?>">
                <button type="button" id="picButton" class="btn btn-blueword btn-md btn-block btn-xs" data-toggle="modal" data-target="#pic_Modal">Cambia</button>
                 <!-- Profile image uploader -->
                  <div class="modal fade" id="pic_Modal" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Introduce una URL</h4>
                           </div>
                           <div class="modal-body">
                              <form action="upload" class="form-group form-login" method="post" name="pic_form"> 			
                                 Url de la imagen:<input type="text" name="pic_form" class="form-control" required />
                                 <input type="submit" value="Sube" class="btn btn-md btn-login" onclick="" /> 
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
             </a>
         </div>
         <div class="col-sm-10">
             <div class="header-title">             
                 <h1><?php echo htmlentities($_SESSION['username']); ?> 
                 <label class="label label-success label-level"><?php echo $level ?> </label>
                 </h1> 
             </div>
            <div class="progress">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow=""
              aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $prueba ?>%">
               <?php 
                if($prueba>8){
                    echo $points.' puntos';
                }else{}
               ?>
              </div>
              <?php 
                if($prueba<8){
                    echo $points.' puntos';
                }else{}
               ?>
              
            </div>
          <!--Cuenta los puntos para subir de nivel --> 
           <label class="label-points label-success"> 
              <?php 
              $calculo = ($maxpoints-$points);
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
              <li class="list-group-item text-right"><span class="pull-left"><strong class="">Vidas: </strong></span>
                  <?php
                  if($life>0){
                      for ($i = 0; $i <$life; $i++) {
                        echo '<span style="color:red;" class="menu-icon fa fa-heart"></span>';
                      }
                  }else{
                      echo '<span style="color:black;" class="menu-icon fa fa-heart"></span>';
                  }
                  ?>
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
               <div class="panel-heading" contenteditable="false">Desbloquea vidas</div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="thumbnail disabled">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre.png">
                           <div class="caption">
                              <h3 style="text-align:center;">
                                 1 vida
                              </h3>
                              <h4 style="text-align:center;">
                                 0,05€
                              </h4>
                              <p align=center>
                             <form style="text-align:center" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                                ">
                                <input style="width:100px;" type="image" src="http://inferna-global.com/pp.png" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                                <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
                            </form>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre2.png">
                           <div class="caption">
                              <h3 style="text-align:center;">
                                 3 vidas
                              </h3>
                              <h4 style="text-align:center;">
                                 0,15€
                              </h4>
                              <p align=center>
                                <form style="text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                                ">
                                <input style="width:100px;" type="image" src="http://inferna-global.com/pp.png" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                                </form>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img class="cofre" alt="300x200" src="/img/cofres/cofre5.png">
                           <div class="caption">
                               <h3 style="text-align:center;">
                                 5 vidas
                              </h3>
                              <h4 style="text-align:center;">
                                 0,35€
                              </h4>
                              <p align=center>
                              <form style="text-align:center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                                ">
                                <input style="width:100px;" type="image" src="http://inferna-global.com/pp.png" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
                                </form>
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
         <span class="error">No estas autorizado para entrar en este apartado</span> Por favor <a href="index">inicia sesión</a>.
      </p>
      <?php endif; ?>
   </body>
</html>