<?php
session_start();
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->getJumlahCuti($_SESSION['user']);

$tglAwal = $_GET["tglAwal"];
$tglAkhir = $_GET["tglAkhir"];

list($day1,$month1,$year1) = explode('/',$tglAwal);
list($day2,$month2,$year2) = explode('/',$tglAkhir);

$total = 0;
$error = true;

if ($year2 > $year1) {
	if ($month2 >= $month1) {
		echo "Ada kesalahan dalam tanggal yang anda masukkan";
	}
	else if ($month2 < $month1) {
		if (($month1 - $month2) < 11) {
			echo "Ada kesalahan dalam tanggal yang anda masukkan";
		}
		else {
			if ($day2 >= $day1) {
				echo "Ada kesalahan dalam tanggal yang anda masukkan";
			}
			else {
				$full = getFullMonth($month1,$tahun1);
				$total = ($full - $day1) + $day2 + 1;
				$error = false;
			}
		}
	}
}
else if ($year2 == $year1) {
	if ($month2 < $month1) {
		echo "Ada kesalahan dalam tanggal yang anda masukkan";
	}
	else if ($month2 > $month1) {
		if (($month2 - $month1) > 1)
		{
			echo "Ada kesalahan dalam tanggal yang anda masukkan";
		}
		else {
			if ($day2 >= $day1) {
				echo "Ada kesalahan dalam tanggal yang anda masukkan";
			}
			else {
				$full = getFullMonth($month1,$tahun1);
				$total = ($full - $day1) + $day2 + 1;
				$error = false;
			}
		}
	}
	else {
		if ($day2 < $day1) {
			echo "Ada kesalahan dalam tanggal yang anda masukkan";
		}
		else if ($day2 > $day1) {
			$total = $day2 - $day1 + 1;
			$error = false;
		}
		else {
			$total = 1;
			$error = false;
		}
	}
}
else {
	echo "Ada kesalahan dalam tanggal yang anda masukkan";
}
if (!$error) {
	if ($total > $result) {
		echo "Maaf, jatah cuti anda tidak mencukupi, saat ini anda hanya memiliki jatah ".$result." hari";
	}
	else {
		$sisa = $result - $total;
		$date = $year1."-".$month1."-".$day1;
		echo "Pengajuan cuti anda sukses, jumlah cuti anda berkurang $total hari.<br />";
		$hasil1 = $sql->setJumlahCuti($_SESSION['user'],$sisa);
		$hasil2 = $sql->setCuti($_SESSION['user'],$date,$total);
		if ($hasil1 == "berhasil" && $hasil2 == "berhasil")
		{
			echo "Data sudah diupdate, Anda memiliki sisa cuti $sisa hari".;
		}
	}
}

function getFullMonth($bulan,$tahun) {
	$fullday;
	if (($tahun%4) == 0) {
		switch ($bulan) {
			case "01" : $fullday = 31;
			case "02" : $fullday = 29;
			case "03" : $fullday = 31;
			case "04" : $fullday = 30;
			case "05" : $fullday = 31;
			case "06" : $fullday = 30;
			case "07" : $fullday = 31;
			case "08" : $fullday = 31;
			case "09" : $fullday = 30;
			case "10" : $fullday = 31;
			case "11" : $fullday = 30;
			case "12" : $fullday = 31;
		}
	}
	else {
		switch ($bulan) {
			case "01" : $fullday = 31;
			case "02" : $fullday = 28;
			case "03" : $fullday = 31;
			case "04" : $fullday = 30;
			case "05" : $fullday = 31;
			case "06" : $fullday = 30;
			case "07" : $fullday = 31;
			case "08" : $fullday = 31;
			case "09" : $fullday = 30;
			case "10" : $fullday = 31;
			case "11" : $fullday = 30;
			case "12" : $fullday = 31;
		}
	}
	return $fullday;
}

?>