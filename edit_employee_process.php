<?php
session_start();
include "include/library.php";

$jabatan = $_SESSION['jabatan'];

$nama = $_POST["nama"];
$jabatan = $_POST["jabatan"];
$alamat = $_POST["alamat"];
$noTelp = $_POST["noTelp"];
$username = $_POST["username"];
$password = $_POST["password"];

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$result = $sql->editEmployee($nama,$jabatan,$alamat,$noTelp,$username,$password);

$sql->close_connection();
?>
<div id="top">
	<?php include "include/header.php" ?>
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
<?php
if ($result == "berhasil") {
	echo "Edit berhasil <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}
else if ($result == "gagal") {
	echo "Edit gagal <br />";
	echo "<a href='employee_list.php'>Back to Employee List</a>";
}
?>
<div id="bottom">
    <?php include "include/footer.php" ?>
</div>