<?php
class indexcontroller
{
	
	public function __construct()
	{
	}

	public function display()
	{
		global $smarty;

		auth::login("","");

		if(auth::isloggedin())
		{
			user::register();
			$sid = sessionmanager::get_user_id();
			$id = user::getuserid( $sid);
			$cid = classes::getcourseid($_SESSION['courseid']);

			if(!auth::isadmin())
			{
				$linkdata =classes::getclass($cid,$id);
				$smarty->assign("data", $linkdata);
				$smarty->assign("courseid", $cid);
				$smarty->display("index.tpl");
			}else
			{
				$rss = classes::getrsslink($cid);
				$count = classes::getcount($cid);

                                if( is_bool($rss) || is_null($rss) ) 
                                {
                                        $rss = "Enter a rss feed";
				
                                }
					
				$linkdata =classes::getallclass($cid,$id);
                                
				$smarty->assign("rss", $rss);
				$smarty->assign("data", $linkdata);
				$smarty->assign("courseid", $cid);
				$smarty->assign("count", $count);
                                $smarty->display("admin.tpl");
			}
		}else
		{
			die("Not logged in");
		}
	}
}

?>

