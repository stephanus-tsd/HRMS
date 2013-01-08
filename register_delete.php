<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$noTelp = $_GET['noTelp'];

$result = $sql->deleteRegisterEmployee($nama,$alamat,$noTelp);

$sql->close_connection();

echo $result;
?>