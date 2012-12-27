<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT * FROM karyawan";
$hasil = $sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee List</title>
<script type="text/javascript">
</script>
</head>

<body>
<div>
<table border="1">
	<tr>
    	<th>Nama</th>
        <th>Jabatan</th>
        <th>Username</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Gaji</th>
        <th>Jumlah Cuti</th>
    </tr>
    <?php
	for ($i = 0; $i < $numrows; $i++) {
	?>
	<tr>
		<td><?php echo $array['nama'][$i]; ?></td>
    	<td><?php echo $array['jabatan'][$i]; ?></td>
        <td><?php echo $array['username'][$i]; ?></td>
		<td><?php echo $array['alamat'][$i]; ?></td>
		<td><?php echo $array['noTelp'][$i]; ?></td>
		<td><?php echo $array['gaji'][$i]; ?></td>
		<td><?php echo $array['jumlahCuti'][$i]; ?></td>
		</tr>
    <?php
	}
	?>
</table>
</div>
<div>
<fieldset>
<legend>Edit Karyawan</legend>
<form method="post" action="edit_employee.php">
Masukkan username dari karyawan yang hendak di-edit : <input type="text" name="username" /> <input type="submit" value="Edit" />
</form>
</fieldset>
</div>
<div>
<fieldset>
<legend>Delete Karyawan</legend>
<form method="post" action="delete_employee.php">
Masukkan username dari karyawan yang hendak di-delete : <input type="text" name="user" />
<input type="submit" value="Delete" />
</form>
</fieldset>
</div>
</body>
</html>
