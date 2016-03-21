<?php
class viewvideocontroller
{
	public function __construct()
	{

	}

	public function display()
	{
		/* if session is not active then go home*/
                if(!auth::isloggedin())
                {
                        header("Location: "._ROOT_);
                        return;
                }

                global $smarty;
                $user = intval(sessionmanager::get_user_id());

		/*if parameters are empty then go home*/
                if(!isset($_GET['course']) || !isset($_GET['video']))
                {
                 	header("Location: "._ROOT_);
                        return;       
                }

		$videoid = filter_var($_GET['video'], FILTER_VALIDATE_INT);
		$courseid = filter_var($_GET['course'], FILTER_VALIDATE_INT);
		
		/*if parameters are of the wrong type then go home*/
		 if( is_bool($videoid) || is_bool($courseid) )
                {
                        header("Location: "._ROOT_);
                        return;
                }

		/*if user isn't in the course, then go home*/
		if(! user::isingroup($user, $courseid))
		{
			header("Location: "._ROOT_);
                        return;
		}

                $video = classes::getvideo($courseid, $user, $videoid);

	
		foreach($video as $v)
		{
			$c = classes::getBookmarks($v, _BOOKURL);
		}
		
		$smarty->assign("data", $video);
		$smarty->assign("url", _NETURL);
		$smarty->assign("books", $c);
		$smarty->assign("murl", _MNETURL);
		$smarty->assign("bookurl", _BOOKURL);
		$smarty->display('video.tpl');
	}
}
?>
