<?php

class ltiauth
{

	public static function isloggedin()
	{
		if(session_id() == "")
		{	
			session_start();
		}
			
		if(session_id() != "")
		{
			if(!empty($_SESSION["loggedin"]) && $_SESSION["loggedin"])
			{
				return True;
			}
		}
		return False;
	
	}

	public static function logout()
	{
		session_end();
	}

	public static function login($user,$passwd)
	{
		//var_dump($_POST);
		if( empty($_POST) || empty($_POST['oauth_signature']))
		{
			return False;
		}

		$httpMethod = 'POST';
		$OAUTH_KEY = _KEY;
		$OAUTH_SECRET = _SECRET;
		
		$request_parameter_array = $_POST;
		unset($request_parameter_array['oauth_signature']);
		ksort($request_parameter_array);
		$request_parameter_str = '';

		foreach($request_parameter_array as $key => $value) {
    			$request_parameter_str .= rawurlencode($key) . '=' . rawurlencode($value) . '&';
		}

		$key = rawurlencode($OAUTH_SECRET) . '&';
		$signature_base = strtoupper($httpMethod) . '&' . rawurlencode( _ROOT_). '&';

		$signature_base .= rawurlencode($request_parameter_str);

		$signature_base = substr($signature_base,0 , -3);
		$signature = base64_encode(hash_hmac("sha1", $signature_base, $key, true));

		//echo $signature."</br>";
		//echo $request_parameter_str."</br>";
		//echo $signature_base."</br>";
		//echo $_REQUEST['oauth_signature'];
		if( $signature == $_REQUEST['oauth_signature'])
		{
			if(empty($_POST['user_id']))
			{
				return False;
			}

			session_start();
			$_SESSION["loggedin"] = True;
			$_SESSION["userid"] = $_POST['user_id'];
			$_SESSION["courseid"] = $_POST['context_id'];
			$_SESSION['role'] = $_POST['roles'];
			
			return True;
		}else
		{
			return False;
		}
	}

	public static function isadmin()
	{
		global $roles;

		if(!self::isloggedin())
		{
			die("not logged in");
		}
		
		foreach($roles as $role)
		{
			if(gettype(strpos($_SESSION['role'], $role)) != "boolean")
			{
				return True;
			} 
		}
		return False;
	}
}
?>
