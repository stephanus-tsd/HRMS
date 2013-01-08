<?php
include "include/library.php";

$sql = new mysql("localhost","root","","hrm");
$sql->connect();

$nama = $_GET['nama'];
$jabatan = $_GET['jabatan'];
$alamat = $_GET['alamat'];
$noTelp = $_GET['noTelp'];

$query = "SELECT * FROM karyawan";

$sql->execute($query);
$array = $sql->get_array();
$numrows = $sql->get_num_rows();

$sql->close_connection();
?>
<script type="text/javascript">
function processFunc() {
	var nama = document.getElementById("nama").value;
	var jabatan = document.getElementById("jabatan").value;
	var alamat = document.getElementById("alamat").value;
	var noTelp = document.getElementById("noTelp").value;
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Mircrosoft.XMLHTTP");
	}
	
	xmlhttp.open("GET","register_accept_process.php?nama="+nama+"&jabatan="+jabatan+"&alamat="+alamat+"&noTelp="+noTelp+"&username="+username+"&password="+password, true);
	xmlhttp.send(null);
	
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 || xmlhttp.status==200) {
			
				status = xmlhttp.responseText;
				if(status == "berhasil") {
					alert("Berhasil menambahkan karyawan baru");
					window.location.assign("register_acceptance.php");
				}
				else if(status == "gagal") {
					alert("Gagal menambahkan karyawan baru");
					window.location.assign("register_acceptance.php");
				}
		}
	}
}
</script>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Username</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Gaji</th>
        <th>Jumlah Cuti</th>
    </tr>
    <?php
    for ($i = 0; $i < $numrows; $i++) {
    ?>
    <tr>
        <td><?php echo $array['nama'][$i]; ?></td>
        <td><?php echo $array['jabatan'][$i]; ?></td>
        <td><?php echo $array['username'][$i]; ?></td>
        <td><?php echo $array['alamat'][$i]; ?></td>
        <td><?php echo $array['noTelp'][$i]; ?></td>
        <td><?php echo $array['gaji'][$i]; ?></td>
        <td><?php echo $array['jumlahCuti'][$i]; ?></td>
    </tr>
    <?php
    }
    ?>
</table>
<br />
Diterima sebagai :
<form action="register_accept_process.php" method="post">
<table>
	<tr>
    	<td>Nama</td>
        <td>:</td>
        <td><input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" /></td>
    </tr>
   <tr>
    	<td>Jabatan</td>
        <td>:</td>
        <td><input type="text" name="jabatan" id="jabatan" value="<?php echo $jabatan; ?>" /></td>
    </tr>
    <tr>
    	<td>Alamat</td>
        <td>:</td>
        <td><input type="text" name="alamat" id="alamat" value="<?php echo $alamat; ?>" /></td>
    </tr>
    <tr>
    	<td>No Telepon</td>
        <td>:</td>
        <td><input type="text" name="noTelp" id="noTelp" value="<?php echo $noTelp; ?>" /></td>
    </tr>
    <tr>
    	<td>Username</td>
        <td>:</td>
        <td><input type="text" name="username" id="username" /></td>
    </tr>
    <tr>
    	<td>Password</td>
        <td>:</td>
        <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" value="Submit" /></td>
    </tr>
</table>
</form>