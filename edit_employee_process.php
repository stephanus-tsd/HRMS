<?php
include "include/library.php";

$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$noTelp = $_POST["noTelp"];
$username = $_POST["username"];
$password = $_POST["password"];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->editEmployee($nama,$jabatan,$alamat,$noTelp,$username,$password);

$sql->close_connection();

if ($result == "berhasil") {
	echo "Edit berhasil <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}
else if ($result == "gagal") {
	echo "Edit gagal <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}
?>