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
}
?>