<?php
class Database {
	public static $db;
	public static $con;
	public $user ="vicente_apli";
	public $pass ="VAzcZdCBgRW10";
	public $host;
	public $ddbb;

	function __construct(){
		$this->user="vicente_apli";$this->pass="VAzcZdCBgRW10";$this->host="localhost";$this->ddbb="uam5";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
                // para que funcione group by
                $con->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
		$con->query("set names 'utf8'");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
