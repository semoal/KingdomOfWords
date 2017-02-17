<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
session_start();

$email=$_POST['email'];
$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">El correo electronico que has introducido no es valido</p>';
    }
    
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Cotraseña erronea.</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
    
    $prep_stmt = "SELECT id FROM members WHERE email = ? OR username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    
    if ($stmt) {
        $stmt->bind_param('ss', $email, $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == "1") {
            // A user with this email address already exists
            $error_msg .= '<p class="error">Un usuario con este correo o este usuario ya existe</p>';
        }
    } else {
        $error_msg .= '<p class="error">Error lo siento, lo repararemos pronto</p>';
    }
    
    
    
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password 
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error?err=Registration failure: INSERT');
                exit();
            }
        }
        $initLevel=1;
        $initAns=0;
        $initGAns=0;
        $initPic="https://kingdomwords-kiatoski.c9users.io/img/default_avatar.png";
        if($insert_profile=$mysqli->prepare("INSERT INTO profile_info (user, level, gooAns, answers, picture) VALUES (?, ?, ?, ?, ?)")) {
            $insert_profile->bind_param('siiis', $username, $initLevel, $initGAns, $initAns, $initPic);
            if (!$insert_profile->execute()) {
                header('Location: ../error?err=Registration failure: INSERT PROFILE');
                exit();
            }
        }
        if($insert_repQuestions=$mysqli->prepare("INSERT INTO repQuestions (username) values (?)")){
            $insert_repQuestions->bind_param('s',$username);
            if(!$insert_repQuestions->execute()){
                header('Location: ../error?err=Registration failure: INSERT REPQUESTIONS');
                exit();
            }
        }
        header('Location: ../views/register_success');
        exit();
    }else {
        echo "Lo siento ha surgido un error lo lamentamos";
    }
}
?>