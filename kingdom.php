<?php 
    $query = "SELECT g.* FROM groups AS g INNER JOIN profile_info AS p ON g.idGrupos=p.idGroup WHERE p.user=?";
    $stmt = $mysqli->prepare($query);
    
    if($stmt){
       $stmt->bind_param('s',$_SESSION["username"]);
       $stmt->execute();
    }
    
?>
<!DOCTYPE html>
<html>
   <head>
      <!-- Meta charset --> 
      <meta charset="UTF-8">
      <meta name="google-signin-scope" content="profile email">
      <link rel="icon" type="image/png" href="img/kingdomLogo.png">
      <meta name="theme-color" content="#1e2b3a" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
      <!-- CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="styles/style.css">
      <link rel="stylesheet" type="text/css" href="styles/modal.css">
      <link rel="stylesheet" type="text/css" href="styles/kingdom.css">

      <!-- Jquery & Bootstrap CDN'S --> 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Titulo de la página -->
      <title>Kingdom of Words</title>
    </head>
    <?php if(login_check($mysqli) == true) { ?>
    <body>
    
    
    
    
    
    
    
    <?php 
      }else{
         echo "<h1> Es necesario que inicies sesión para entrar al apartado de kingdoms. </h1>";
      }
      ?>
    </body>
       
   
</html>