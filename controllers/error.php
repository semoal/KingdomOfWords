<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (! $error) {
    $error = 'Oops! Algo extraño ha sucedido, nuestros monos estan trabajando en ello';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <h1>Oops! Algo extraño ha sucedido, nuestros monos estan trabajando en ello</h1>
        <p class="error"><?php echo $error; ?></p>  
    </body>
</html>
