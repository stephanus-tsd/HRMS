<?php
session_start();
include "include/library.php";

$user = $_GET["username"];
$tingkat = $_SESSION['jabatan'];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$query = "SELECT * FROM karyawan WHERE username = '$user'";
$hasil = $sql->execute($query);
$array = $sql->get_array();

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Employee</title>
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
        <?php 
        if($tingkat == "admin") {
            include "include/link_admin.php"; 
        }
        else if($tingkat == "boss") {
            include "include/link_boss.php";
        }
        else {
            include "include/link_user.php";
        }
        ?>
    </div>
    <br  />
    <div id="content">
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
                <td>
                	<select name="jabatan">
                    	<?php if ($array['jabatan'][0] == "admin"){
							  		?>
                                    <option selected value="admin">Admin</option>
                                    <option value="boss">Boss</option>
                                    <option value="user">User</option>
                                    <?php
							  }
							  else if ($array['jabatan'][0] == "boss"){
							  		?>
                                    <option selected value="boss">Boss</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <?php
							  }
							  else {
							  		?>
                                    <option selected value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="boss">Boss</option>
                                    <?php
							  }
						?>
                    </select>
                </td>
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
                <td><input type="password" name="password" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" value="Submit" /></td>
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
