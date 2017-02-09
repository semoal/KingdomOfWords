<?php
    session_start();
    date_default_timezone_set('Europe/Madrid');
    require_once('phpmailer/PHPMailerAutoload.php');
    $email=$_SESSION["email"];
    $mail = new PHPMailer;
    $mail->isSMTP();
    //$mail->SMTPDebug = 2; //cambiar al 0 cuando o pasemos a prod
    //$mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "welcome.kingdomwords@gmail.com";
    $mail->Password = "adminpassword.1";
    $mail->setFrom('welcome.kingdomwords@gmail.com', 'Kingdom of Words');
    $mail->addAddress($email); //EMAIL GET POST
    $mail->Subject = 'Bienvenido a Kingdom of Words';
    $mail->msgHTML(file_get_contents('phpmailer/emailTemplate.html'), dirname(__FILE__));
    $mail->AltBody = 'Este correo ha sigo generado automaticamente.';
    $mail->send();
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Ya estas registrado</title>
      <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="img/kingdomLogo.png">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/modal.css">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style type="text/css">
        .col-padding {
            margin-top:50%;
        }
    </style>
    <body>
         <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-offset-4" style="text-align:center;">
               <div class="container-middle">
                  <div class="col-md col-padding">
                     <img src="img/kingdomLogo.png" alt="logo" class="img-thumbnail">
                        <h1 style="color:#ffcc00;">¡Felicidades ya estas registrado en Kingdom of Words!</h1>
                        <p style="color:white;">Ahora inicia sesión para empezar tu aventura: </p>
                        <a href="index.php"> <button class="btn btn-md btn-login"> Iniciar sesión</button> </a>
                  </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
