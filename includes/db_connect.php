<?php
include_once 'psl-config.php';   
global $mysqli;
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
    header("Location: ../error.php?err=Unable to connect to MySQL");
    exit();
}
#PACO EL PUTO AMO
/* class dbConnect{
    private $mysqli;
    function __construct(){
        $this->mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($this->mysqli->connect_error) {
            header("Location: ../error.php?err=Unable to connect to MySQL");
            exit();
        }
    }
    function kk(){
            if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
    }
}
*/