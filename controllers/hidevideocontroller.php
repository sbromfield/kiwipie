<?php
class hidevideocontroller
{

	public function __construct()
	{
	
	}

	public function display()
	{
		if(auth::isloggedin() && auth::isadmin())
		{
			classes::hidevideo($_GET['video'], $_GET['course']);
		}
		header("Location: ". _ROOT_);		
	}
}
?>
