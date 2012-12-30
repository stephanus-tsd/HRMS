<?php
session_start();
include "include/library.php";

$jabatan = $_SESSION['jabatan'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT * FROM karyawan";

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee List</title>
<script type="text/javascript">
var key;
function getKey(kunci) {
	key = kunci;
	if (key == "") {
		document.getElementById("nilai").value = "";
	}
}

function showEmployee() {
	var value = document.getElementById("nilai").value;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("hasil").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","get_employee.php?key="+key+"&value="+value,true);
	xmlhttp.send();
}
</script>
</head>

<body>
<div id="top">
	<?php include "include/header.php" ?>
</div>
<div>
    <?php 
    if($jabatan == "admin") {
        include "include/link_admin.php"; 
    }
    else if($jabatan == "boss") {
        include "include/link_boss.php";
    }
    else {
        include "include/link_user.php";
    }
    ?>
</div>
<br  />
<div id="hasil">
<table border="1">
	<tr>
    	<th>Nama</th>
        <th>Jabatan</th>
        <th>Alamat</th>
        <th>No Telepon</th>
    </tr>
    <?php
	for ($i = 0; $i < $numrows; $i++) {
	?>
	<tr>
		<td><?php echo $array['nama'][$i]; ?></td>
    	<td><?php echo $array['jabatan'][$i]; ?></td>
		<td><?php echo $array['alamat'][$i]; ?></td>
		<td><?php echo $array['noTelp'][$i]; ?></td>
		</tr>
    <?php
	}
	?>
</table>
</div>
<div>
<form>
Cari berdasarkan : <select name="kolom" onchange="getKey(this.value)">
<option value="">Semua</option>
<option value="nama">Nama</option>
<option value="jabatan">Jabatan</option>
<option value="alamat">Alamat</option>
<option value="noTelp">No. Telp</option>
</select>
<input type="text" name="nilai" id="nilai" />
<input type="button" onclick="showEmployee()" value="Cari" />
</form>
</div>
<div id="bottom">
    <?php include "include/footer.php" ?>
</div>
</body>
</html>
