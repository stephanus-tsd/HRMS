<?php
session_start();
include "include/library.php";

$nama = $_SESSION['nama'];

unset($_SESSION['nama']);
unset($_SESSION['level']);
unset($_SESSION['user']);

echo "Terima kasih saudara $nama atas kunjungannya.<br />";
echo "<a href='HOME.php'>Klik disini</a> untuk kembali.";
?>