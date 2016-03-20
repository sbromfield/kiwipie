<?php
class viewvideocontroller
{
	public function __construct()
	{

	}

	public function display()
	{
		
                if(!auth::isloggedin())
                {
                        header("Location: "._ROOT_);
                        return;
                }

                global $smarty;
                $user = intval(sessionmanager::get_user_id());

                if(!isset($_GET['course']) || !isset($_GET['video']))
                {
                 	header("Location: "._ROOT_);
                        return;       
                }

		$videoid = filter_var($_GET['video'], FILTER_VALIDATE_INT);
		$courseid = filter_var($_GET['course'], FILTER_VALIDATE_INT);


		 if( is_bool($videoid) || is_bool($courseid) )
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
