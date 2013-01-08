<?php
class mysql {
	private $db;
	private $host;
	private $user;
	private $pass;
	private $datab;
	private $query;
	private $result;
	private $num_rows;
	private $connect;
	
	public function __construct($host,$user,$password,$database) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $password;
		$this->datab = $database;
	}
	
	public function connect() {
		$this->connect = mysql_connect($this->host,$this->user,$this->pass) or die('Cannot connect');
		$this->db = mysql_select_db($this->datab) or die('Cannot select database');
	}
	
	public function login($username,$password) {
		$word = "SELECT nama,jabatan FROM karyawan WHERE username = '$username' AND password = '$password'";
		$this->result = mysql_query($word);
	}
	
	public function execute($query) {
		$this->result = mysql_query($query);
		if ($this->result) return "berhasil";
		else return "gagal";
	}
	
	public function get_array() {
		while($row = mysql_fetch_array($this->result)) {
			foreach($row as $key => $value) {
				$array[$key][] = $value;
			}
		}
		return $array;
	}
	
	public function get_num_rows() {
		return mysql_num_rows($this->result);
	}
	
	public function close_connection() {
		mysql_close($this->connect);
	}
	
	public function signUp($nama,$jabatan,$alamat,$noTelp,$username,$password) {
		if ($jabatan == "admin") {
			$gaji = 50000;
			$jumlahCuti = 10;
		}
		else if ($jabatan == "boss") {
			$gaji = 30000;
			$jumlahCuti = 5;
		}
		else {
			$gaji = 10000;
			$jumlahCuti = 3;
		}
		$query = "INSERT INTO karyawan(username,password,nama,jabatan,alamat,noTelp,gaji,jumlahCuti) VALUES ('$username','$password','$nama','$jabatan','$alamat','$noTelp','$gaji','$jumlahCuti')";
		if (mysql_query($query)) {
			return "berhasil";
		}
		else return "gagal";
	}
	
	public function editEmployee($nama,$jabatan,$alamat,$noTelp,$username,$password) {
		if ($jabatan == "admin") {
			$gaji = 50000;
			$jumlahCuti = 10;
		}
		else if ($jabatan == "boss") {
			$gaji = 30000;
			$jumlahCuti = 5;
		}
		else {
			$gaji = 10000;
			$jumlahCuti = 3;
		}
		if ($password == "") {
			$query = "UPDATE karyawan SET nama = '$nama',jabatan = '$jabatan',alamat = '$alamat',noTelp = '$noTelp',gaji = '$gaji',jumlahCuti = '$jumlahCuti' WHERE username = '$username'";
		}
		else {
			$pass = md5($password);
			$query = "UPDATE karyawan SET nama = '$nama',jabatan = '$jabatan',alamat = '$alamat',noTelp = '$noTelp',gaji = '$gaji',jumlahCuti = '$jumlahCuti',password = '$pass' WHERE username = '$username'";
		}
		
		if (mysql_query($query)) {
			return "berhasil";
		}
		else 
			return "gagal";
	}
	
	public function deleteEmployee($username) {
		$query = "DELETE FROM karyawan WHERE username = '$username'";
		if (mysql_query($query)) {
			return "berhasil";
		}
		else
			return "gagal";
	}
	
	public function getJumlahCuti($username) {
		$query = "SELECT jumlahCuti FROM karyawan WHERE username = '$username'";
		$this->execute($query);
		$result = $this->get_array();
		return $result['jumlahCuti'][0];
	}
	
	public function setJumlahCuti($username,$jmlCuti) {
		$query = "UPDATE karyawan SET jumlahCuti = '$jmlCuti' WHERE username = '$username'";
		if (mysql_query($query)) {
			return "berhasil";
		}
		else 
			return "gagal";
	}
	
	public function setCuti($username,$tglAwal,$cuti) {
		$query = "INSERT INTO cuti(username,tanggal,lama) VALUES ('$username','$tglAwal','$cuti')";
		if (mysql_query($query)) {
			return "berhasil";
		}
		else
			return "gagal";
	}
	
	public function getYear() {
		$query = "SELECT DISTINCT year(tanggal) FROM cuti ORDER BY year(tanggal) ASC";
		$this->execute($query);
		$result = $this->get_array();
		return $result;
	}
	
	public function getReportCuti($year) {
		$query = "SELECT DISTINCT month(tanggal) AS bulan FROM cuti WHERE year(tanggal) = $year";
		$this->execute($query);
		while($row = mysql_fetch_array($this->result))
		{
			$query = "SELECT month(tanggal) AS bln,COUNT(username) AS jml FROM cuti WHERE month(tanggal) =".$row['bulan'];
			$result = mysql_query($query);
			while($baris = mysql_fetch_array($result)) {
				$hasil[$baris['bln']] = $baris['jml'];
			}
		}
		return $hasil;
	}
	
	public function getLamaCuti($user,$tgl) {
		$query = "SELECT lama FROM cuti WHERE username = '$user' AND tanggal = '$tgl'";
		$this->execute($query);
		$result = $this->get_array();
		return $result['lama'][0];
	}
	
	public function deleteCuti($user,$tgl) {
		$query = "DELETE FROM cuti WHERE username = '$user' AND tanggal = '$tgl'";
		if($this->execute($query)) {
			return "berhasil";
		}
		else {
			return "gagal";
		}
	}
	
	public function registerEmployee($nama,$jabatan,$alamat,$noTelp) {
		$query = "INSERT INTO register VALUES ('$nama','$jabatan','$alamat','$noTelp')";
		if ($this->execute($query)) {
			return "berhasil";
		}
		else {
			return "gagal";
		}
	}
	
	public function deleteRegisterEmployee($nama,$alamat,$noTelp) {
		$query = "DELETE FROM register WHERE nama = '$nama' AND alamat = '$alamat' AND noTelp = '$noTelp'";
		if ($this->execute($query)) {
			return "berhasil";
		}
		else {
			return "gagal";
		}
	}
	
	public function absen($username,$tglMasuk,$jamMasuk,$tglKeluar,$jamKeluar) {
		$query = "INSERT INTO absensi VALUES ('$username','$tglMasuk','$jamMasuk','$tglKeluar','$jamKeluar')";
		if($this->execute($query)) {
			return "berhasil";
		}
		else {
			return "gagal";
		}
	}
}
?>