<?php
   include_once 'includes/db_connect.php';
   include_once 'includes/functions.php';
   include_once 'includes/register.inc.php';
   
   sec_session_start();
   
   if (login_check($mysqli) == true) {
       $logged = 'Has iniciado sesión';
       header("Location: ../profile.php");
   } else {
       $logged = 'No has iniciado sesión';
   }
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
      <!-- Google Login JS 
      <script src="https://apis.google.com/js/platform.js" async defer></script> -->
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/modal.css">
      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <title>Kingdom of Words</title>
   </head>
   <body>
      <?php
         if (isset($_GET['error'])) {
             echo '<p class="error">Datos incorrectos</p>';
         }
         if (!empty($error_msg)) {
             echo $error_msg;
         }
         ?> 
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-offset-4" style="text-align:center;">
               <div class="container-middle">
                  <div class="col-md">
                     <img src="http://eatlogos.com/education_logos/png/vector_sun_book_logo.png" alt="logo" class="img-thumbnail">
                  </div>
                  <!-- Buttons for open modals and google LOGIN --> 
                  <!-- <div class="g-signin2" data-onsuccess="onSignIn" data-theme="light" data-width="100%" data-height="50" data-longtitle="true"></div> -->
               
                  <button type="button" id="loginButton" class="btn btn-blueword btn-md btn-block" data-toggle="modal" data-target="#loginModal">Inicia sesión</button><br>
                  <button type="button" id="registerButton" class="btn btn-blueword btn-md btn-block" data-toggle="modal" data-target="#registerModal">Registro</button>
                  <!-- LOGIN Modal -->
                  <div class="modal fade" id="loginModal" role="dialog">
                     <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Iniciar sesión</h4>
                           </div>
                           <div class="modal-body">
                              <form action="includes/process_login.php" class="form-group form-login" method="post" name="login_form"> 			
                                 Usuario o Email: <input type="text" name="user_or_email" class="form-control" required />
                                 Contraseña: <input type="password" name="password" id="password" class="form-control"/>
                                 <input type="submit" value="Login" class="btn btn-md btn-login" onclick="formhash(this.form, this.form.password);" /> 
                              </form>
                              <a style="cursor:pointer;"> 
                              <span data-toggle="modal" data-target="#registerModal">Si no tienes cuenta registrate aquí</span>
                              </a>
                              <!--  Muestra si el usuario ha iniciado sesión o no
                              <?php echo $logged ?>
                              --> 
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- REGISTER MODAL --> 
                  <div class="modal fade" id="registerModal" role="dialog">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="container">
                                <a href="#" data-toggle="popover" data-trigger="focus" class="popup container-popup" title="¿Cómo me registro?" data-content="El usuario no puede contener caracteres especiales. La contraseña de un minimo de 6 caracteres con al menos: Mayusculas, minusculas y un número. Tu contraseña y la confirmación de esta deben coincidir">?</a>
                              </div>
                              <h4 class="modal-title">Registrate</h4>
                           </div>
                           <div class="modal-body">
                              <div class="form-group form-login"></div>
                              <form method="post" class="form-group" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                                 Usuario: <input class="form-control" type='text' name='username' id='username' /><br>
                                 Email: <input class="form-control" type="text" name="email" id="email" /><br>
                                 Contraseña: <input class="form-control" type="password" name="password" id="password"/><br>
                                 Repite contraseña: <input class="form-control" type="password"  name="confirmpwd" id="confirmpwd" /><br>
                                 <input type="button" value="Registrate"  class="btn btn-login btn-md" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);" /> 
                              </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover();   
      });
      </script>
   </body>
</html>
   

   