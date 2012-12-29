<?php
session_start();
?>
<div align="center">
<div id="myjquerymenu" class="jquerycssmenu">
	<?php
	if ($_SESSION['user'] == "admin") {
		echo "<ul>";
			echo "<li><a href='HOME.php'>Home</a></li>";
			echo "<li>Employee</li>";
				echo "<ul>";
					echo "<li><a href='employee_list.php'>Employee List</a></li>";
					echo "<li><a href='input_new_employee.php'>Input New Employee</a></li>";
				echo "</ul>";
			echo "<li>Cuti</li>";
				echo "<ul>";
					echo "<li><a href='cuti.php'>Pengajuan Cuti</a></li>";
					echo "<li><a href=''>Statistik Pengajuan Cuti</a></li>";
		echo "</ul>";
	}
	?>
</div>
<div style="float:right; margin-top:-38px;">
	<p><a href="../LOGIN.php" id="login">LOGIN</a>
</div>
</div>