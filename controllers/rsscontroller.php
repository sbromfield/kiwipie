<?php
class rsscontroller
{

	public function __construct()
	{

	}

	public function display()
	{
		if(auth::isloggedin() && auth::isadmin())
		{

			$url = str_replace(" ", "%20", $_GET['rss']);
			$rss = filter_var($url, FILTER_VALIDATE_URL);
			
			
			if( ! is_bool($rss))
			{
				$num = classes::getcourseid($_SESSION['courseid']);
				classes::updatecourse($num, $rss);
			}
		}
		header("Location: ". _ROOT_);
	}
}

?>
