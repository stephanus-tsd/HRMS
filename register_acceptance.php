<?php
session_start();
include "include/library.php";

$jabatan = $_SESSION['level'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT * FROM register";
$sql->execute($query);

$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Penerimaan Pendaftaran Karyawan Baru</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type="text/javascript">
function acceptFunc(nama,jabatan,alamat,noTelp) {
	var r = confirm("Are you sure to accept this ?");
	if (r == true) {
		if(window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp = new ActiveXObject("Mircrosoft.XMLHTTP");
		}
		
		xmlhttp.open("GET","register_accept.php?nama="+nama+"&jabatan="+jabatan+"&alamat="+alamat+"&noTelp="+noTelp, true);
		xmlhttp.send(null);
		
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 || xmlhttp.status==200) {
				
					document.getElementById("hasil").innerHTML=xmlhttp.responseText;
			}
		}
	}
	else {
		alert("Action canceled");
	}
}

function deniedFunc(nama,alamat,noTelp) {
	var r = confirm("Are you sure to denied this ?");
	if (r == true) {
		if(window.XMLHttpRequest) {
			xmlhttp = new XMLHttpRequest();
		}
		else {
			xmlhttp = new ActiveXObject("Mircrosoft.XMLHTTP");
		}
		
		xmlhttp.open("GET","register_delete.php?nama="+nama+"&alamat="+alamat+"&noTelp="+noTelp, true);
		xmlhttp.send(null);
		
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 || xmlhttp.status==200) {
				
					status = xmlhttp.responseText;
					if(status == "berhasil") {
						alert("Delete berhasil");
						window.location.assign("register_acceptance.php");
					}
					else if(status == "gagal") {
						alert("Delete gagal");
					}
			}
		}
	}
	else {
		alert("Action canceled");
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
    	<div id="hasil" style="padding-top:5px;">
        <table border="1">
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Status</th>
            </tr>
            <form>
            <?php
            for ($i = 0; $i < $numrows; $i++) {
            ?>
            <tr>
                <td><?php echo $array['nama'][$i]; ?></td>
                <td><?php echo $array['jabatan'][$i]; ?></td>
                <td><?php echo $array['alamat'][$i]; ?></td>
                <td><?php echo $array['noTelp'][$i]; ?></td>
                <td>
                	<img src="include/accept_icon.jpg" onclick="acceptFunc('<?php echo $array['nama'][$i]; ?>','<?php echo $array['jabatan'][$i]; ?>','<?php echo $array['alamat'][$i]; ?>','<?php echo $array['noTelp'][$i]; ?>')" />
                    <img src="include/icon_denied_48.png" onclick="deniedFunc('<?php echo $array['nama'][$i]; ?>','<?php echo $array['alamat'][$i]; ?>','<?php echo $array['noTelp'][$i]; ?>')" />
                </td>
            </tr>
            <?php
            }
            ?>
            </form>
        </table>
        </div>
    </div>
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
