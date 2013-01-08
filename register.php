<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<script type="text/javascript">
function regEmployee() {
	var nama = document.getElementById("nama").value;
	var jabatan = document.getElementById("jabatan").value;
	var alamat = document.getElementById("alamat").value;
	var noTelp = document.getElementById("noTelp").value;
	
	if (nama == "" || jabatan == "" || alamat == "" || noTelp == "") {
		alert("Masih ada field yang kosong");
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
				status=xmlhttp.responseText;
				if (status == "berhasil"){
					alert("Anda telah mendaftar sebagai karyawan disini, silahkan menunggu konfirmasi selanjutnya");
					window.location.assign("LOGIN.php");
				}
				else{
					alert("Maaf anda belum berhasil mendaftar");
				}
			}
		}
		xmlhttp.open("GET","register_process.php?nama="+nama+"&jabatan="+jabatan+"&alamat="+alamat+"&noTelp="+noTelp,true);
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
    <div align="center"><b style="font-size:18px;">Register Karyawan</b></div>
    <hr />
    <div id="content">
    	
    	<form>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" id="nama" /></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>
                	<select name="jabatan" id="jabatan">
                    	<option value="admin">Admin</option>
                        <option value="boss">Boss</option>
                        <option value="user">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat" id="alamat" /></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><input type="text" name="noTelp" id="noTelp" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="button" value="Register" onclick="regEmployee()" /></td>
            </tr>
        </table>
        </form>
    </div>
    <div id="bottom">
    	<?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
