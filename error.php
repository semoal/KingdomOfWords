<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (! $error) {
    $error = 'Oops! Algo extraño ha sucedido, estamos trabajando en ello';
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
        <h1>Ha surgido un imprevisto, lamentamos las molestias...</h1>
        <p class="error"><?php echo $error; ?></p>  
    </body>
</html>
