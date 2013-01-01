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
<link rel="stylesheet" href="css/main.css" type="text/css" />
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

function deleteFunc(user) {
	var xmlhttp;
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
			
			xmlhttp.open("GET","delete_employee.php?user="+user, true);
			xmlhttp.send(null);
			setTimeout(function(){alert("Mohon Tunggu")},5000);
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 || xmlhttp.status==200) {
					
						status = xmlhttp.responseText;
						if(status == "OK") {
							alert("Delete berhasil");
							window.location.assign("employee_list.php");
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
<div id="container">
    <div id="top">
        <img src="include/HR_logo.gif" />
            <div style="margin-top:50px; padding-left:40px; padding-right:100px; float:right">
            <h1>Human Resource Management System</h1>
            </div>
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
    <br />
    <div id="content">
        <div id="hasil" style="padding-top:5px;">
        <table border="1">
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Gaji</th>
                <th>Jumlah Cuti</th>
                <th>Delete</th>
            </tr>
            <form>
            <?php
            for ($i = 0; $i < $numrows; $i++) {
            ?>
            <tr>
                <td><a href = "edit_employee.php?username=<?php echo $array['username'][$i]; ?>"><?php echo $array['nama'][$i]; ?></a></td>
                <td><?php echo $array['jabatan'][$i]; ?></td>
                <td><?php echo $array['username'][$i]; ?></td>
                <td><?php echo $array['alamat'][$i]; ?></td>
                <td><?php echo $array['noTelp'][$i]; ?></td>
                <td><?php echo $array['gaji'][$i]; ?></td>
                <td><?php echo $array['jumlahCuti'][$i]; ?></td>
                <td><img src="include/attributes_delete_icon.png" onclick="deleteFunc('<?php echo $array['username'][$i]; ?>')" /></td>
                <!--deleteFunc(<?php //echo $array['username'][$i]; ?>)
                <input type="button" value="Delete" onclick="test()" />
                -->
            </tr>
            <?php
            }
            ?>
            </form>
        </table>
        </div>
        <div style="padding-top:10px;">
        <form>
        Cari berdasarkan : <select name="kolom" onchange="getKey(this.value)">
        <option value="">Semua</option>
        <option value="nama">Nama</option>
        <option value="jabatan">Jabatan</option>
        <option value="username">Username</option>
        <option value="alamat">Alamat</option>
        <option value="noTelp">No. Telp</option>
        </select>
        <input type="text" name="nilai" id="nilai" />
        <input type="button" onclick="showEmployee()" value="Cari" />
        </form>
        </div>
    </div>
    <br  />
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
