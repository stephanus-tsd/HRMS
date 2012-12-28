<?php
include "include/library.php";

$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$noTelp = $_POST["noTelp"];
$username = $_POST["username"];
$password = md5($_POST["password"]);

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->signUp($nama,$jabatan,$alamat,$noTelp,$username,$password);
if ($result == "berhasil") {
	echo "Insert berhasil <br />";
	echo "<a href=''>Back to Home</a>";
}
else if ($result == "gagal") {
	echo "Insert gagal <br />";
	echo "<a href=''>Back to Home</a>";
}
?>
