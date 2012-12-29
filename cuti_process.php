<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$tglAwal = $_GET["tglAwal"];
$tglAkhir = $_GET["tglAkhir"];

echo $tglAwal;

?>