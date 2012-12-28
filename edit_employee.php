<?php
include "include/library.php";

$user = $_GET["username"];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT * FROM karyawan WHERE username = '$user'";
$hasil = $sql->execute($query);
$array = $sql->get_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Employee</title>
</head>

<body>
<div>
	<form method="post" action="edit_employee_process.php">
	<table>
    	<tr>
        	<td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?php echo $array['nama'][0]; ?>" /></td>
        </tr>
        <tr>
        	<td>Jabatan</td>
            <td>:</td>
            <td><input type="text" name="jabatan" value="<?php echo $array['jabatan'][0]; ?>" /></td>
        </tr>
        <tr>
        	<td>Alamat</td>
            <td>:</td>
            <td><input type="text" name="alamat" value="<?php echo $array['alamat'][0]; ?>" /></td>
        </tr>
        <tr>
        	<td>No Telepon</td>
            <td>:</td>
            <td><input type="text" name="noTelp" value="<?php echo $array['noTelp'][0]; ?>" /></td>
        </tr>
    	<tr>
        	<td>Username</td>
            <td>:</td>
            <td><input type="text" name="username" value="<?php echo $array['username'][0]; ?>" readonly="readonly" style="background-color:#CCCCCC" /></td>
        </tr>
        <tr>
        	<td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" value="<?php echo $array['password'][0]; ?>" /></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" value="Submit" /></td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
