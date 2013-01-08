<?php
include "include/library.php";

$nama = $_GET['nama'];
$jabatan = $_GET['jabatan'];
$alamat = $_GET['alamat'];
$noTelp = $_GET['noTelp'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->registerEmployee($nama,$jabatan,$alamat,$noTelp);
echo $result;
?>