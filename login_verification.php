<?php
include "include/library.php";
session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$sql->login($user,$pass);
$hasil = $sql->get_array();
$sql->close_connection();
if ($hasil["jabatan"] = "admin") {
	echo "admin";
}
else {
	echo "gatau";
}
?>