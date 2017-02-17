<?php
   include_once '../controllers/db_connect.php';
   include_once '../controllers/functions.php';
   sec_session_start();
   $query='SELECT user, answers, gooAns, points,picture, level FROM profile_info';
   if(strlen($_POST["searchPlayer"])>0){
       
     $query=$query." WHERE user LIKE '".$_POST["searchPlayer"]."%'";
     
   }
   if(isset($_POST["filter"])){
      $query=$query.' ORDER BY '.$_POST["filter"].' '.$_POST["order"];

   }else{
      $query=$query.' ORDER BY (gooAns/answers) DESC';
   }
  
    $results = $mysqli->query($query);
  
   ?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Meta charset --> 
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
      <title>Kingdom of Words</title>
   </head>
   <?php if(login_check($mysqli) == true) { ?>
   <body class="ranking-body">
      <div class="navbar-more-overlay"> </div>
      <!-- Navbar --> 
      <nav class="navbar navbar-inverse navbar-fixed-top animate">
         <div class="container navbar-more visible-xs"> </div>
         <!-- All view --> 
         <div class="container">
            <div class="navbar-header hidden-xs">
               <a class="navbar-brand" href="profile">
                  <img style="margin-top:-15px;" src="../img/logo.png" width=150px alt="logo" class="img-thumbnail">
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
                  <a href="../controllers/new_play">
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
                  <a href="../controllers/logout">
                  <span class="menu-icon fa fa-sign-out" aria-hidden="true">
                  </span>
                  Salir
                  </a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Vista para usuario que no ha iniciado sesión --> 
            <form class="form-ranking" method=post action="ranking">
               <select class="form-control move-right" name="filter">
                 <option value="" disabled selected>Selecciona un filtro</option>
                 <option value="user">Por nombre</option>
                 <option value="level">Por nivel</option>
                 <option value="(gooAns/answers)">Por precision</option>
               </select>
               <select class="form-control" name="order" onchange="this.form.submit()">
                 <option value="" disabled selected>Selecciona un orden</option>
                 <option value="ASC">Ascendente</option>
                 <option value="DESC">Descendente</option>
               </select>
               <input type="text" class="form-control move-left" name="searchPlayer" placeholder="Busca a un jugador"/>
               
            </form>
                 <?php 
                     $i=1;
                    while($result=$results->fetch_assoc()){ 
                 ?>
              <div class="panel panel-default widget">
                  <div class="panel-heading">
                      <span class="label label-info">
                          Posicion: <?php echo $i; $i++; ?> </span>
                  </div>
                  <div class="">
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
                                            <div class="progress-bar" role="progressbar" aria-valuenow=""
                                            aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round($result["gooAns"]/$result["answers"]*100,2); ?>%">
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
          </div>
      </div>
                 <?php 
                    } 
                 ?>
      <!-- Usuario no inicia sesión -->
      <?php 
      }else{
         echo "<h1> Es necesario que inicies sesión para entrar al apartado de rankings. </h1>";
      }
      ?>
      <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();   
      });
      </script>
   </body>
</html>