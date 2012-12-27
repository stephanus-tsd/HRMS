<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$user = $_GET["user"];

$result = $sql->deleteEmployee($user);

if ($result == "berhasil") {
	echo "OK";
}
else if ($result == "gagal") {
	echo "Gagal";
}

?>