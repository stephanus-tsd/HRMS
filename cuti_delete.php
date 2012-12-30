<?php
session_start();
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT a.username AS user,nama,jabatan,tanggal,lama FROM karyawan a, cuti b WHERE a.username = b.username";

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancel Cuti</title>
<script type="text/javascript">
function deleteFunc() {
	var xmlhttp;
	var user = document.getElementById("inputUserDelete").value;
	var tgl = document.getElementById("tglCuti").value;
	
	if (user == "" || tgl == "")
	{
		alert("Field masih kosong");
	}
	else
	{
		var r = confirm("Are you sure ?");
		if (r == true) {
			
			if(window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Mircrosoft.XMLHTTP");
			}
			
			xmlhttp.open("GET","cuti_delete_process.php?user="+user+"&tgl="+tgl, false);
			xmlhttp.send(null);
			setTimeout(function(){alert("Mohon Tunggu")},5000);
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 || xmlhttp.status==200) {
					
						status = xmlhttp.responseText;
						if(status == "OK") {
							alert("Delete berhasil");
						}
						else if(status == "Gagal") {
							alert("Delete gagal");
						}
				}
			}
		}
		else {
			alert("Delete user dibatalkan");
		}
	}
}
</script>
</head>

<body>
<div>
<table border="1">
	<tr>
    	<td>Username</td>
        <td>Nama</td>
        <td>Jabatan</td>
        <td>Tanggal Cuti</td>
        <td>Lama Cuti</td>
    </tr>
    <?php
	for($i = 0 ; $i < $numrows ; $i++) {
	?>
    <tr>
    	<td><?php echo $array['user'][$i]; ?></td>
        <td><?php echo $array['nama'][$i]; ?></td>
        <td><?php echo $array['jabatan'][$i]; ?></td>
        <td><?php echo $array['tanggal'][$i]; ?></td>
        <td><?php echo $array['lama'][$i]; ?></td>
    </tr>
    <?php
	}
	?>
</table>
</div>
<div>
<fieldset>
<legend>Delete Karyawan</legend>
<form>
Masukkan data dari karyawan yang cuti hendak di-cancel :
<table>
	<tr>
    	<td>Username</td>
        <td>:</td>
        <td><input type="text" name="user" id="inputUserDelete" /></td>
    </tr>
    <tr>
    	<td>Tanggal cuti</td>
        <td>:</td>
        <td><input type="text" name="tgl" id="tglCuti" /></td>
    </tr>
    <tr>
    	<td colspan="3"><input type="submit" value="Delete" onclick="deleteFunc()" /></td>
    </tr>
</table>
</form>
</fieldset>
</div>
</body>
</html>
