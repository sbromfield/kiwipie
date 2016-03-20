<?php
class unhidevideocontroller
{

	public function __construct()
	{
	
	}

	public function display()
	{
		if(auth::isloggedin() && auth::isadmin())
		{
			classes::unhidevideo($_GET['video'], $_GET['course']);
		}	
		header("Location: ". _ROOT_);	
	}
}
?>
