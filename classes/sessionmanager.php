<?php
class sessionmanager
{
	public static function start_mysession()
	{
		global $sessionclass;
		$sessionclass::start_mysession();
	}

	public static function end_mysession()
	{
		global $sessionclass;
		$sessionclass::end_mysession();

	}

	public static function get_session_data()
	{
		global $sessionclass;
		return $sessionclass::get_session_data();


	}

	public static function get_user_id()
	{
		global $sessionclass;
		return $sessionclass::get_user_id();
	}
}
?>
