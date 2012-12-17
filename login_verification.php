<?php
include "include/library.php";
session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];

$mysql = new MySQL("localhost","","","hrm");
$mysql->connect();

$mysql->login();
?>