<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$user = $_GET['user'];
$tgl = $_GET['tgl'];

$lamaCuti = $sql->getLamaCuti($user,$tgl);
$jumlahCuti = $sql->getJumlahCuti($user);

$jumlahCuti = $jumlahCuti + $lamaCuti;
$hasil1 = $sql->deleteCuti($user,$tgl);
$hasil2 = $sql->setJumlahCuti($user,$jumlahCuti);

$sql->close_connection();

if ($hasil1 == "berhasil" && $hasil2 == "berhasil") {
	echo "OK";
}
else {
	echo "Gagal";
}
?>