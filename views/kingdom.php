<?php 
   
    include_once '../controllers/db_connect.php';
    include_once '../controllers/functions.php';
    include_once '../controllers/profile_checker.php';
    include_once '../controllers/group_checker.php';
    sec_session_start();
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="../img/kingdomLogo.png">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../styles/style.css">
      <link rel="stylesheet" type="text/css" href="../styles/modal.css">
      <link rel="stylesheet" type="text/css" href="../styles/ranking.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <?php if (login_check($mysqli) == true) : ?>
      <title>Bienvenido <?php echo htmlentities($_SESSION['username']); ?></title>
        <link rel="stylesheet" type="text/css" href="../styles/profile.css">
   </head>
   <style> 
   .panel {
       margin-bottom: 20px;
       background-color: #ffffff;
       border: 1px solid transparent;
       border-radius: 4px;
       -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
       box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
   }
   </style>
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
                  <a href="../views/kingdom">
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
               <li><a href="../controllers/quitGroup">Salir grupo</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="summary">
                  <div class="row">
                     <div class="col-sm-4">
                        <h4>Preguntas contestadas</h4>
                        <div class="progress" title="No. of active users on-line" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-primary" style="width:<?php echo $contestadas?>%;">
                              <?php echo $gPregCont.' contestadas'?>
                           </div>
                        </div>
                        <h4>Preguntas restantes</h4>
                        <div class="progress" title="No. of code snippets" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-danger" style="width:<?php echo $preguntasRestantes?>%;">
                              <?php echo $preguntasRestantes.' restantes' ?>
                           </div>
                        </div>
                        <h4>Preguntas correctas</h4>
                        <div class="progress" title="No. of completed requests" data-toggle="tooltip">
                           <div class="progress-bar progress-bar-success" style="width:<?php echo $correctas?>%;">
                              <?php echo round($correctas)?>%
                           </div>
                        </div>
                     </div>
                     <!--/col-4-->
                     <div class="col-sm-8">
                     <div class="col-sm-2">
                      <a class="pull-left">
                     <div class="profile-header-container">   
           		         <div class="profile-header-img">
                           <img class="img-responsive" src="<?php echo $pictureGrupo?>" />
                              <div class="rank-label-container">
                                  <span class="label label-default rank-label" data-toggle="modal" data-target="#pic_Modal">Cambia</span>
                              </div>
                           </div>
                        </div> 
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
                              <form action="../controllers/changeGroup" class="form-group form-login" method="GET" name="pic_form"> 			
                                 Url de la imagen:<input type="text" name="pic_group" class="form-control" required />
                                 <input type="submit" value="Sube" class="btn btn-md btn-login" onclick="" /> 
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
             </a>
         </div>
                        
                        </h4>
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
                                 <h4 class="text-success">
                                    <span class="label label-success pull-right">Grupo</span>
                                    <?php echo $nombreGrupo ?>
                                 </h4>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="well">
                                 <h4 class="text-success"><span class="label label-success pull-right">+ <?php echo $totalMiembros?></span> Cantidad de miembros </h4>
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
                     <?php 
                         $query = 'SELECT p.user, p.picture, p.answers, p.gooAns, p.level FROM profile_info AS p INNER JOIN groups AS g ON g.idGrupos=p.idGroup WHERE p.idGroup = '.$idGroups.'';
                         $members= $mysqli->query($query);
                         
                       
                       while($result=$members->fetch_assoc()){ 
                     ?>
                     <div>
                        <div class="panel panel-default widget">
                               <ul class="list-group">
                                   <li class="list-group-item">
                                       <div class="row">
                                           <div class="col-xs-4 col-md-1">
                                               <img style="width: 80px;height: 80px;background-size:cover;object-fit:cover;" src="<?php echo $result["picture"]?>" class="img-circle img-responsive" alt="" />
                                            </div>
                                           <div class="col-xs-8 col-md-11">
                                               <div>
                                                   <a href="">
                                                       <?php echo $result["user"]?></a>
                                               </div>
                                               <div class="action">
                                                   Preguntas contestadas:
                                                   <button type="button" class="btn btn-danger btn-xs" title="Approved">
                                                       <?php echo $result["answers"]?>
                                                   </button>
                                                   Preguntas correctas:
                                                   <button type="button" class="btn btn-success btn-xs" title="Approved">
                                                       <?php echo $result["gooAns"]?>
                                                   </button>
                                                   Nivel: 
                                                  <label class="label label-warning ">  <?php echo $result["level"]?></label>
         
                                                   <div style="margin-top:10px;" class="progress">
                                                     <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($result["gooAns"]/$result["answers"]*100,2); ?>%">
                                                      Precisión: <?php echo round($result["gooAns"]/$result["answers"]*100,2); ?>%
                                                     </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </li>
                               </ul>
                           
                       </div>
                   </div>
                     <?php } ?>
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
                        <form action="../controllers/kingdom_login" class="form-group form-login" method="post" name="pic_form"> 			
                           Nombre grupo: <input type="text" name="user_group" class="form-control" required />
                           Contraseña: <input class="form-control" type="password" name="password_group" id="password"/><br>
                           <input type="submit" value="¡Entra!" class="btn btn-md btn-login" onclick="" /> 
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
                        <form action="../controllers/kingdom_register" method="post" class="form-group" name="registration_form">
                           Nombre grupo: <input class="form-control" type='text' name='username_group' id='username' /><br>
                           Contraseña: <input class="form-control" type="password" name="password_group" id="password"/><br>
                           Repite contraseña: <input class="form-control" type="password"  name="password_confirm_group" id="confirmpwd" /><br>
                           Url de la imagen del grupo:<input type="text" name="pic_group" class="form-control" required />
                           <input type="submit" value="¡Crea!"  class="btn btn-login btn-md" /> 
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