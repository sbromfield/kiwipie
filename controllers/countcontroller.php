<?php
class countcontroller
{

	public function __construct()
	{

	}

	public function display()
	{
		if(auth::isloggedin() && auth::isadmin())
		{
			/*
			$rss = filter_var($_GET['rss'], FILTER_VALIDATE_URL);

			if( ! is_bool($rss))
			{
				$num = classes::getcourseid($_SESSION['courseid']);
				classes::updatecourse($num, $rss);
			}

			*/
			$cid = classes::getcourseid($_SESSION['courseid']);	
			$r = classes::updatecount($cid, $_GET['values']);
		}
		header("Location: ". _ROOT_);
	}
}

?>
