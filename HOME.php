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

$sql->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME</title>

</head>

<body>
<div id="container">
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
    <div id="content">
    </div>
    <br  />
    <br  />
    <div id="bottom">
    	<?php include "include/footer.php" ?>
    </div>
</div>
</body>
</html>
