<?php 
   
    include_once '../controllers/db_connect.php';
    include_once '../controllers/functions.php';
    include_once '../controllers/profile_checker.php';
    sec_session_start();

    $prep_stmt = 'SELECT g.nombre, g.password, g.picture FROM groups AS g INNER JOIN profile_info AS p ON g.idGrupos=p.idGroup WHERE p.user=?';
    $results = $mysqli->prepare($prep_stmt);
    $results->bind_param('s',$_SESSION["username"]);
    $results->execute();
    $results->store_result();
    $results->bind_result($nombreGrupo,$passwordGrupo,$pictureGrupo);
    $results->fetch();
    
    
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="../img/kingdomLogo.png">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- JavaScript -->
      <script type="text/JavaScript" src="../js/sha512.js"></script> 
      <script type="text/JavaScript" src="../js/forms.js"></script> 
      
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../styles/style.css">
      <link rel="stylesheet" type="text/css" href="../styles/modal.css">
      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
      <?php if (login_check($mysqli) == true) : ?>
      <title>Bienvenido <?php echo htmlentities($_SESSION['username']); ?></title>
        <link rel="stylesheet" type="text/css" href="../styles/profile.css">
   </head>
   
   <body>
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a href="profile" class="navbar-brand">
                  <img style="margin-top:-15px;" src="../img/logo.png" width=150px alt="logo" class="img-thumbnail">
               </a>
            </div>
            <ul class="nav navbar-nav navbar-right mobile-bar">
                <li>
                  <a href="../views/profile">
                  <span class="menu-icon fa fa-user"></span>
                  <span style="color:#ffcc00;"> <?php echo $_SESSION["username"] ?> </span>
                  </a>
               </li>
               <li>
                  <a href="../controllers/new_play">
                  <span class="menu-icon fa fa-gamepad"></span>
                  Juega
                  </a>
               </li>
               <li>
                  <a href="/kingdom">
                  <span class="menu-icon fa fa-users" aria-hidden="true">
                  </span>
                  Reinos
                  </a>
               </li>
               <li>
                  <a href="../views/ranking">
                  <span class="menu-icon fa fa-cloud-upload" aria-hidden="true">
                  </span>
                  Marcadores
                  </a>
               </li>
               <li>
                  <a href="../controllers/logout">
                  <span class="menu-icon fa fa-sign-out" aria-hidden="true">
                  </span>
                  Salir
                  </a>
               </li>
            </ul>
         </div>
      </nav>
        <?php 
            if(isset($nombreGrupo)){
        ?> 
        <!-- Vista para usuarios con grupo -->
         <div class="container-fluid">
            <ul class="nav nav-tabs" id="adminTab">
               <li class="active"><a data-toggle="tab" href="#summary">Resumen</a></li>
               <li><a data-toggle="tab" href="#revenue">Miembros</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="summary">
                  <div class="row">
                     <div class="col-sm-4">
                        <h4>Active users</h4>
                        <div class="progress" title="No. of active users on-line" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-primary" style="width:40%;"></div>
                        </div>
                        <h4>Snippets</h4>
                        <div class="progress" title="No. of code snippets" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-danger" style="width:76%;"></div>
                        </div>
                        <h4>Completed</h4>
                        <div class="progress" title="No. of completed requests" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-success" style="width:60%;"></div>
                        </div>
                        <h4>Pending</h4>
                        <div class="progress" title="No. of pending requests" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-warning" style="width:30%;"></div>
                        </div>
                     </div>
                     <!--/col-4-->
                     <div class="col-sm-8">
                        <h4 class="text-center">
                           IMAGE GRUPO
                        </h4>
                        <div id="chart1" class="big-chart"></div>
                     </div>
                     <!--/col-8-->
                  </div>
                  <!--/row-->
                  <hr>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="well">
                                 <h4 class="text-danger"><span class="label label-danger pull-right">- 9%</span> Usuarios nuevos </h4>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="well">
                                 <h4 class="text-success"><span class="label label-success pull-right">+ 3%</span> Returning </h4>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="well">
                                 <h4 class="text-primary"><span class="label label-primary pull-right">201</span> Sales </h4>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="well">
                                 <h4 class="text-success"><span class="label label-success pull-right">+ 24%</span> Pageviews </h4>
                              </div>
                           </div>
                        </div>
                        <!--/row-->    
                     </div>
                     <!--/col-12-->
                  </div>
                  <!--/row-->
               </div>
               <!--/pane stats-->
               <!--pane rev-->
               <div class="tab-pane" id="revenue">
                  <div class="well well-sm text-center">
                     Here are the latest revenue reports for your account.
                     <div class="btn-group btn-group-xs pull-right" data-toggle="buttons">
                        <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option1"> Day
                        </label>
                        <label class="btn btn-sm btn-default">
                        <input type="radio" name="options" id="option2"> Week
                        </label>
                        <label class="btn btn-sm btn-default active">
                        <input type="radio" name="options" id="option3"> Month
                        </label>
                     </div>
                  </div>
               </div>
               <!--/pane rev-->
            </div>
         </div>
<?php       
   }else{
   ?> 
<div class="container">
   <div class="row">
      <div class="col-md-4 col-md-offset-4" style="text-align:center;">
         <div class="container-middle">
            <div class="col-md">
               <img src="../img/kingdomLogo.png" alt="logo" class="img-thumbnail">
            </div>
            <button type="button" class="btn btn-blueword btn-md btn-block" data-toggle="modal" data-target="#init_Grupo">Entra en un grupo</button><br>
            <button type="button" class="btn btn-blueword btn-md btn-block" data-toggle="modal" data-target="#register_Grupo">Crea grupo</button>
            <!-- VISTA PARA USUARIOS SIN GRUPO INICIAR SESIÓN-->
            <div class="modal fade" id="init_Grupo" role="dialog">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Inicia sesión en un grupo</h4>
                     </div>
                     <div class="modal-body">
                        <form action="controllers/group_login" class="form-group form-login" method="post" name="pic_form"> 			
                           Nombre grupo: <input type="text" name="user_group" class="form-control" required />
                           Contraseña: <input class="form-control" type="password" name="password_group" id="password"/><br>
                           <input type="submit" value="Sube" class="btn btn-md btn-login" onclick="" /> 
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- VISTA PARA USUARIOS SIN GRUPO CREAR UN GRUPO-->
            <div class="modal fade" id="register_Grupo" role="dialog">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> Crea un grupo</h4>
                     </div>
                     <div class="modal-body">
                        <form action="controllers/registergroup" method="post" class="form-group" name="registration_form">
                           Nombre grupo: <input class="form-control" type='text' name='username_group' id='username' /><br>
                           Contraseña: <input class="form-control" type="password" name="password_group" id="password"/><br>
                           Repite contraseña: <input class="form-control" type="password"  name="password_confirm_group" id="confirmpwd" /><br>
                           Url de la imagen del grupo:<input type="text" name="pic_group" class="form-control" required />
                           <input type="button" value="Crea!"  class="btn btn-login btn-md" onclick="controllers/registergroup" /> 
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
        <?php
            }
        ?>
      <?php else : ?>
      <p>
         <span class="error">No estas autorizado para entrar en este apartado</span> Por favor <a href="index">inicia sesión</a>.
      </p>
      <?php endif; ?>
   </body>
</html>