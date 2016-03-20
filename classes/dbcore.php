<?php
class dbcore
{
	private static $dbcore = null;
	private static $query;

	private function __construct(){
		$dsn = 'mysql:host='._DBHOST.';dbname='._DBNAME;
		try
		{
			self::$query = new PDO($dsn,_DBUSER, _DBPASS);
			self::$query->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e)
		{
			var_dump($e);
			die("Database error.");
		}
	}

	public static function getInstance(){
		if( self::$dbcore == null ){
			self::$dbcore = new dbcore();
		}
		return self::$query;
	}
}
?>
