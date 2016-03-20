<?php
class cassession
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
		$r = phpCAS::getAttributes();

                return $r;
	}

	public static function get_user_id()
	{
               $r = phpCAS::getAttributes();

               return $r["Panther ID"];

	}
}
?>
