<?php
session_start();
include "include/library.php";

$jabatan = $_SESSION['level'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT a.username AS user,nama,tglMasuk,jamMasuk,tglKeluar,jamKeluar FROM karyawan a, absensi b WHERE a.username = b.username";

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Absensi Karyawan</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type='Text/JavaScript' src='include/scw.js'></script>
<script type="text/javascript">
function blank(a) { if(a.value == a.defaultValue) a.value = ""; }

function unblank(a) { if(a.value == "") a.value = a.defaultValue; }

function prosesFunc() {
	var xmlhttp;
	var username = document.getElementById("username").value;
	var tglMasuk = document.getElementById("tglMasuk").value;
	var tglKeluar = document.getElementById("tglKeluar").value;
	var jamMasuk = document.getElementById("jamMasuk").value;
	var jamKeluar = document.getElementById("jamKeluar").value;
	
	if (tglMasuk == "" || tglKeluar == "" || username == "" || jamMasuk == "" || jamKeluar == "") {
		alert("Ada field yang masih kosong");
	}
	else {
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
				document.getElementById("warning").innerHTML=xmlhttp.responseText;
				status = xmlhttp.responseText;
				if(status == "berhasil") {
					window.location.assign("absensi.php");
				}
			}
		}
		xmlhttp.open("GET","absensi_process.php?username="+username+"&tglMasuk="+tglMasuk+"&jamMasuk="+jamMasuk+"&tglKeluar="+tglKeluar+"&jamKeluar="+jamKeluar,false);
		xmlhttp.send();
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
        <div id="hasil" style="padding-top:5px; float:left">
        <table border="1">
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Jam Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Jam Keluar</th>
            </tr>
            <?php
            for ($i = 0; $i < $numrows; $i++) {
            ?>
            <tr>
                <td><?php echo $array['user'][$i]; ?></td>
                <td><?php echo $array['nama'][$i]; ?></td>
                <td><?php echo $array['tglMasuk'][$i]; ?></td>
                <td><?php echo $array['jamMasuk'][$i]; ?></td>
                <td><?php echo $array['tglKeluar'][$i]; ?></td>
                <td><?php echo $array['jamKeluar'][$i]; ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        </div>
        <div style="float:right; padding-top:-100px; padding-right:30px;">
        <fieldset>
        <legend>Input Absen</legend>
        <form>
        <table>
        	<tr>
            	<td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
            	<td>Tanggal Masuk</td>
                <td>:</td>
                <td><input name="tglMasuk" id="tglMasuk" value="" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)" /></td>
            </tr>
            <tr>
            	<td>Jam Masuk</td>
                <td>:</td>
                <td><input type="text" name="jamMasuk" id="jamMasuk" /></td>
            </tr>
            <tr>
            	<td>Tanggal Keluar</td>
                <td>:</td>
                <td><input name="tglKeluar" id="tglKeluar" value="" onclick="scwShow(this,event);" onfocus="blank(this)" onblur="unblank(this)" /></td>
            </tr>
            <tr>
            	<td>Jam Keluar</td>
                <td>:</td>
                <td><input type="text" name="jamKeluar" id="jamKeluar" /></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
                <td>&nbsp;</td>
            	<td><input type="button" value="submit" onclick="prosesFunc()" /></td>
            </tr>
        </table>
        </form>
        <div id="warning">
        </div>
        </fieldset>
        </div>
    </div>
    <br  />
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
