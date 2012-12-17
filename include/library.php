<?php
class MySQL {
	private $db;
	private $host;
	private $user;
	private $password;
	private $database;
	private $query;
	private $result;
	private $num_rows;
	private $connect;
	
	public function __construct($host,$user,$password,$database) {
		$this->$host = $host;
		$this->$user = $user;
		$this->$password = $password;
		$this->$database = $database;
	}
	
	public function connect() {
		$this->connect = mysql_connect($this->host,$this->user,$this->password) or die('Cannot connect');
		$this->db = mysql_select_db($this->database) or die('Cannot select database');
	}
	
	public function login() {
		$query = "SELECT nama FROM karyawan WHERE username = '" + $this->user + "' AND password = '" + $this->password + "'";
		$this->result = mysql_query($query);
		if ($this->result) echo $this->result;
		else echo "gagal";
	}
	
	public function execute($query) {
		$this->result = mysql_query($query);
		if ($this->result) echo "Query berhasil<br />";
		else echo "Query gagal<br />";
	}
	
	public function get_array() {
		while($row = mysql_fetch_array($this->result))
		{
			$array[] =  $row;
		}
		return $array;
	}
	
	public function get_num_rows() {
		return mysql_num_rows($this->result);
	}
	
	public function close_connection() {
		mysql_close($this->connect);
	}
	
	public function signUp() {
	}
}
?>