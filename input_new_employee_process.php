<?php
session_start();
include "include/library.php";

$tingkat = $_SESSION['jabatan'];

$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$noTelp = $_POST["noTelp"];
$username = $_POST["username"];
$password = md5($_POST["password"]);

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->signUp($nama,$jabatan,$alamat,$noTelp,$username,$password);

$sql->close_connection();
?>
<link rel="stylesheet" href="css/main.css" type="text/css" />
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
    <?php
    if ($result == "berhasil") {
        echo "Insert berhasil <br />";
        echo "<a href='employee_list.php'>Back to Employee List</a>";
    }
    else if ($result == "gagal") {
        echo "Insert gagal <br />";
        echo "<a href='employee_list.php'>Back to Employee List</a>";
    }
    ?>
    </div>
    <div id="bottom">
        <?php include "include/footer.php" ?>
    </div>
</div>