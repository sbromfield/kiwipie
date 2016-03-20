<?php

class casauth
{

	public static function isloggedin()
	{
		return phpCAS::isAuthenticated();
	}

	public static function logout()
	{
		//cas has no log out
	}

	public static function login($user,$passwd)
	{
		if(self::isloggedin()){
                        return True;
                }else
                {
                        return phpCAS::forceAuthentication();
                }
	}

	public static function isadmin()
	{
		global $db;
		if(!self::isloggedin())
		{
			die("not logged in");
		}

		//$data = phpCAS::getAttributes();
                $pid = intval(sessionmanager::get_user_id());
		$sql = "select isadmin from users where pid = :pid";

		$st = $db->prepare($sql);
		$st->execute(array(':pid'=>$pid));
		$r = intval($st->fetchColumn());
		//die($r);
		return $r;
	}
}
?>
