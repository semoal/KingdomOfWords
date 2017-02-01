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
    <div class="navbar-more-overlay"></div>
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
    	<!-- empieza la pesca --> 
        <h1>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</h1>
        <div class="container">
             <img src="https://www.drupal.org/files/profile_default.png" class="img-responsive img-rounded"></img>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page.
            </p>
        </div>
       
        <?php else : ?>
            <p>
                <span class="error">No estas autorizado para entrar en este apartado</span> Por favor <a href="index.php">inicia sesión</a>.
            </p>
        <?php endif; ?>
    </body>
</html>