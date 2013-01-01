<?php
session_start();
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$user = $_SESSION['user'];
$jabatan = $_SESSION['jabatan'];

if ($user == "") {
	header('location:LOGIN.php');
}

$query = "SELECT * FROM karyawan WHERE username = '$user'";
$sql->execute($query);
$result = $sql->get_array();

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
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
    	<div style="float:right">
        Selamat datang, <?php echo $_SESSION['nama']; ?>
        </div>
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
    	<div id="profile">
        Data Profil User
        <table>
        	<tr>
            	<td>Nama</td>
                <td>:</td>
                <td><?php echo $result['nama'][0]; ?></td>
            </tr>
            <tr>
            	<td>Jabatan</td>
                <td>:</td>
                <td><?php echo $result['jabatan'][0]; ?></td>
            </tr>
            <tr>
            	<td>Alamat</td>
                <td>:</td>
                <td><?php echo $result['alamat'][0]; ?></td>
            </tr>
            <tr>
            	<td>No Telepon</td>
                <td>:</td>
                <td><?php echo $result['noTelp'][0]; ?></td>
            </tr>
            <tr>
            	<td>Jumlah cuti</td>
                <td>:</td>
                <td><?php echo $result['jumlahCuti'][0]; ?></td>
            </tr>
        </table>
        </div>
    </div>
    <br  />
    <br  />
    <div id="bottom">
    	<?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
