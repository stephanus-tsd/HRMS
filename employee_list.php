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
function deleteFunc() {
	var xmlhttp;
	var user = document.getElementById("inputUserDelete").value;

	if (user == "")
	{
		alert("Field masih kosong");
	}
	else
	{
		var r = confirm("Are you sure to delete user : " + user + " ?");
		if (r == true) {
			
			if(window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			}
			else {
				xmlhttp = new ActiveXObject("Mircrosoft.XMLHTTP");
			}
			
			xmlhttp.open("GET","delete_employee.php?user="+user, false);
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

function editFunc() {
	var username = document.getElementById("inputUserEdit").value;
	if (username == "") {
		alert("Field masih kosong");
	}
	else {
		var xmlhttp;
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
			document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","edit_employee.php?username="+username,true);
		xmlhttp.send(null);
		
		window.location.assign("edit_employee.php");
	}
}
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
<div>
</div>
</div>
<div>
<fieldset>
<legend>Edit Karyawan</legend>
<form method="post">
Masukkan username dari karyawan yang hendak di-edit : <input type="text" name="username" id="inputUserEdit" /> <input type="button" value="Edit" onclick="editFunc()" />
</form>
</fieldset>
</div>
<div>
<fieldset>
<legend>Delete Karyawan</legend>
<form>
Masukkan username dari karyawan yang hendak di-delete : <input type="text" name="user" id="inputUserDelete" />
<input type="submit" value="Delete" onclick="deleteFunc()" />
</form>
</fieldset>
</div>
</body>
</html>
