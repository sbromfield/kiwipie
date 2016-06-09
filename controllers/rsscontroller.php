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

			//$rss = filter_var($_GET['rss'], FILTER_VALIDATE_URL);
			//need to figure out if this is a problem. filter_var wasn't validating the rss url
			$rss = $_GET['rss'];
			
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
