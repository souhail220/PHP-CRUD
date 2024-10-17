<?php

class Database
{
	private $dbServer = "localhost";
	private $dbUser = "root";
	private $dbPassword = "";
	private $dbname = "userdata";
	protected $conn;

	// constructor
	public function __construct()
	{
		try {
			$dsn = "mysql:host=$this->dbServer; dbname=$this->dbname; charset=utf8";
			$options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
			$this->conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
		} catch (PDOException $e) {
			echo "Connection Error " . $e->getMessage();
		}
	}
}
