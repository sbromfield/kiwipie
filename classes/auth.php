<?php
class auth
{

	public static function isloggedin(){
		global $authclass;
		return $authclass::isloggedin();
	}


	public  static function logout(){
		sessionmanager::end_mysession();
	}

	public static function login($user="",$passwd="")
	{
		global $authclass;
		return $authclass::login($user,$passwd);	
	}
	
	public static function isadmin()
	{
		global $authclass;
		return $authclass::isadmin();
	}
	
}
?>
