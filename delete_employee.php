<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$user = $_POST["user"];

$result = $sql->deleteEmployee($user);

if ($result == "berhasil") {
	echo "Delete karyawan berhasil <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}
else if ($result == "gagal") {
	echo "Delete karyawan gagal <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}

?>