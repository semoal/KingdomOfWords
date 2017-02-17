<?php
   include_once 'controllers/db_connect.php';
   include_once 'controllers/functions.php';
   sec_session_start();

   if(isset($_POST["username"])){
      $query='INSERT INTO validate (username) VALUES ("'.$_POST["username"].'")';
      $mysqli->query($query);
      header("Location: ../index");
   }
    
  
   ?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Meta charset --> 
      <meta charset="UTF-8">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../styles/style.css">
      <link rel="stylesheet" type="text/css" href="../styles/modal.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <title>Kingdom of Words - Validate</title>
   </head>   <body>
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-offset-4" style="text-align:center;">
               <div class="container-middle">
                  <div class="col-md">
                     <img src="img/kingdomLogo.png" alt="logo" class="img-thumbnail">
                  </div>
                  <button type="button" id="loginButton" class="btn btn-blueword btn-md btn-block" data-toggle="modal" data-target="#validateModal">Validar tu cuenta</button><br>
                  <!-- Validate Modal -->
                  <div class="modal fade" id="validateModal" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Validar cuenta</h4>
                           </div>
                           <div class="modal-body">
                              <form action="validate" class="form-group form-login" method="post" name="login_form"> 			
                                 Usuario: <input type="text" name="username" class="form-control" required />
                                 <input type="submit" value="Validar" class="btn btn-md btn-login"/> 
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>