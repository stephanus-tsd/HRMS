<?php
include "include/library.php";
session_start();

$user = $_POST['user'];
$pass = md5($_POST['pass']);

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$sql->login($user,$pass);
$hasil = $sql->get_array();

$sql->close_connection();

if ($hasil != NULL) {
	$_SESSION['nama'] = $hasil['nama'][0];
	$_SESSION['level'] = $hasil['jabatan'][0];
	$_SESSION['user'] = $user;
	header('Location:HOME.php');
}
else {
	header('Location:LOGIN.php');
}

?>