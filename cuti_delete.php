<?php
session_start();
include "include/library.php";

$jabatan = $_SESSION['level'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT a.username AS user,nama,jabatan,tanggal,lama FROM karyawan a, cuti b WHERE a.username = b.username";

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cancel Cuti</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type="text/javascript">
function deleteFunc(user,tgl) {
	var xmlhttp;
	//var user = document.getElementById("inputUserDelete").value;
	//var tgl = document.getElementById("tglCuti").value;
	
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
			
			xmlhttp.open("GET","cuti_delete_process.php?user="+user+"&tgl="+tgl, true);
			xmlhttp.send(null);
			setTimeout(function(){alert("Mohon Tunggu")},5000);
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 || xmlhttp.status==200) {
					
						status = xmlhttp.responseText;
						if(status == "OK") {
							alert("Delete berhasil");
							window.location.assign("cuti_delete.php");
						}
						else if(status == "Gagal") {
							alert("Delete gagal");
						}
				}
			}
		}
		else {
			alert("Delete cuti dibatalkan");
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
    <br  />
    <div id="content">
        <div>
        <table border="1">
            <tr>
                <td>Username</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Tanggal Cuti</td>
                <td>Lama Cuti</td>
                <td>Cancel Cuti</td>
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
                <td><img src="include/cancel_icon.png" onclick="deleteFunc('<?php echo $array['user'][$i]; ?>','<?php echo $array['tanggal'][$i]; ?>')" /></td>
            </tr>
            <?php
            }
            ?>
        </table>
        </div>
    </div>
    <br  />
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
