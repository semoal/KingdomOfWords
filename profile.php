<?php 
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
   sec_session_start();
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS --> 
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/profile.css">
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
               <a class="navbar-brand" href="#">Kingdom of Words</a>
            </div>
            <ul class="nav navbar-nav navbar-right mobile-bar">
               <li>
                  <a href="#">
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
         <div class="col-sm-10">
            <h1><?php echo htmlentities($_SESSION['username']); ?> </h1>
              <div class="progress">
    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40%
    </div>
  </div>
         </div>
         <div class="col-sm-2">
             <a class="pull-right">
                 <img title="profile image" width="150px" height="150px" class="img-circle img-responsive" src="http://www.rlsandbox.com/img/profile.jpg">
             </a>
         </div>
      </div>
      <br>
      <div class="row">
         <div class="col-sm-3">
            <!-- col izq-->
            <ul class="list-group">
               <li class="list-group-item text-muted" contenteditable="false">Perfil</li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Primera visita</strong></span> Yokse</li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Ultima visita</strong></span> Ayer</li>
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Preguntas correctas: </strong></span> 152
               <li class="list-group-item text-right"><span class="pull-left"><strong class="">Consejo en: </strong></span> 7 horas y 12 minutos
               </li>
            </ul>
         </div>
         <!--col medio-->
         <div class="col-sm-9" contenteditable="false" style="">
            <div class="panel panel-default">
               <div class="panel-heading">Tus ultimas preguntas contestadas</div>
                <div class="list-group">
                    <a href="#" class="list-group-item">
                      <span style="float:right;" class="label label-success label-right">✓</span>
                      <h4 class="list-group-item-heading">First List Group Item Heading</h4>
                      <p class="list-group-item-text">List Group Item Text</p>
                    </a>
                    <a href="#" class="list-group-item">
                      <span style="float:right;" class="label label-danger label-right">X</span>
                      <h4 class="list-group-item-heading">Second List Group Item Heading</h4>
                      <p class="list-group-item-text">List Group Item Text</p>
                    </a>
                </div>
            </div>
        <!-- Segunda col medio -->
            <div class="panel panel-default target">
               <div class="panel-heading" contenteditable="false">Tesoros</div>
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img alt="300x200" src="http://lorempixel.com/600/200/cats">
                           <div class="caption">
                              <h3>
                                 Tesoro1
                              </h3>
                              <p>
                                 Tesoro1 descripcion
                              </p>
                              <p>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img alt="300x200" src="http://lorempixel.com/600/200/business">
                           <div class="caption">
                              <h3>
                                 Tesoro2
                              </h3>
                              <p>
                                 Tesoro2 desc
                              </p>
                              <p>
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="thumbnail">
                           <img alt="300x200" src="http://lorempixel.com/600/200/cats">
                           <div class="caption">
                              <h3>
                                 Tesoro3
                              </h3>
                              <p>
                                 Tesoro3 desc
                              </p>
                              <p>
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