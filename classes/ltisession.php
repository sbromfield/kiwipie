<?php
class ltisession
{
	public static $data = array();

	public static function start_mysession()
	{
	
	}

	public static function end_mysession()
	{

	}

	public static function get_session_data()
	{
	
	}

	public static function get_user_id()
	{
               if(session_id() != "")
		{
			return user::getuserid($_SESSION['userid']);
		}
		
		return "fail";
	}
}
?>
