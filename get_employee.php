<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$key = $_GET["key"];
$value = $_GET["value"];

if ($key == "" && $value == "") {
	$query = "SELECT * FROM karyawan";
}
else if ($key != "" && $value != "") {
	$query = "SELECT * FROM karyawan WHERE $key = '$value'";
}

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();

echo "<table border='1'>
	<tr>
    	<th>Nama</th>
        <th>Jabatan</th>
        <th>Username</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Gaji</th>
        <th>Jumlah Cuti</th>
    </tr>";

	for ($i = 0; $i < $numrows; $i++) {
	echo "<tr>";
		echo "<td><a href='edit_employee.php?username=".$array['username'][$i]."'>".$array['nama'][$i]."</a></td>";
    	echo "<td>".$array['jabatan'][$i]."</td>";
        echo "<td>".$array['username'][$i]."</td>";
		echo "<td>".$array['alamat'][$i]."</td>";
		echo "<td>".$array['noTelp'][$i]."</td>";
		echo "<td>".$array['gaji'][$i]."</td>";
		echo "<td>".$array['jumlahCuti'][$i]."</td>";
		echo "<td><img src='include/attributes_delete_icon.png' onclick='deleteFunc('".$array['username'][$i]."')' /></td>";
	echo "</tr>";
	}
echo "</table>";
?>