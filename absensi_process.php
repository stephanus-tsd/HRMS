<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$username = $_GET['username'];
$tglMasuk = $_GET['tglMasuk'];
$jamMasuk = $_GET['jamMasuk'];
$tglKeluar = $_GET['tglKeluar'];
$jamKeluar = $_GET['jamKeluar'];

list($day1,$month1,$year1) = explode('/',$tglMasuk);
list($day2,$month2,$year2) = explode('/',$tglKeluar);

if ($tglMasuk != $tglKeluar) {
	echo "Ada kesalahan dalam pemasukkan tanggal";
}
else {
	if ($jamKeluar <= $jamMasuk) {
		echo "Ada kesalahan dalam pemasukkann jam";
	}
	else {
		$date1 = $year1."-".$month1."-".$day1;
		$date2 = $year2."-".$month2."-".$day2;
		$hasil = $sql->absen($username,$date1,$jamMasuk,$date2,$jamKeluar);
		echo $hasil;
	}
}
?>