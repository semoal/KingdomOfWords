<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
session_start();

$error_msg = "";
if (isset($_POST['username_group'], $_POST['password_group'])) {
    // Sanitize and validate the data passed in
    $group_name = filter_input(INPUT_POST, 'username_group', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password_group', FILTER_SANITIZE_STRING);
    /*
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Cotraseña erronea.</p>';
    }
    */

    $prep_stmt = "SELECT idGrupos FROM groups WHERE nombre = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) {
        $stmt->bind_param('s', $group_name);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == "1") {
            // A user with this email address already exists
            $error_msg .= '<p class="error">Un grupo con este nombre ya existe</p>';
        }
    } else {
        $error_msg .= '<p class="error">Error lo siento, lo repararemos pronto</p>';
    }
    
    
    $initPic = $_POST['pic_group'];
    if(!is_array(getimagesize($initPic))){
        $initPic="https://kingdomwords-kiatoski.c9users.io/img/default_avatar.png";
        
    }
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
        
        
        // Insert the new group into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO groups (nombre, password,picture,salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $group_name, $password,$initPic,$random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error?err=Registration failure: INSERT');
                exit();
            }
        }
        header('Location: ../views/kingdom');
        exit();
    }else {
        echo $error_msg;
    }
}
?>