<?php
include_once 'psl-config.php';   
global $mysqli;
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
$mysqli->set_charset('utf8');
$mysqli->query("SET collation_connection = latin_1");
if ($mysqli->connect_error) {
    header("Location: ../error?err=Unable to connect to MySQL");
    exit();
}