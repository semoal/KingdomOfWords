<?php
include_once 'psl-config.php';   
global $mysqli;
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
    header("Location: ../error?err=Unable to connect to MySQL");
    exit();
}