<?php
class indexcontroller
{

	
	function __construct()
	{
		//var_dump($_POST);
	}

	function display()
	{
		global $smarty;

		auth::login("","");

		if(auth::isloggedin())
		{
			//die(var_dump($_POST));
			user::register();
			$sid = sessionmanager::get_user_id();
			$id = user::getuserid( $sid);
			$cid = classes::getcourseid($_SESSION['courseid']);

			$r =  groups::getgroups(intval($id));
			if(!auth::isadmin())
			{
				$linkdata =classes::getclass($cid,$id);
				$smarty->assign("user", $r);
				$smarty->assign("data", $linkdata);
				$smarty->assign("courseid", $cid);
				$smarty->display("index.tpl");
			}else
			{
				if(!empty($_POST['rss']))
				{
					//
				}

				$rss = classes::getrsslink($cid);

                                if( is_bool($rss) || is_null($rss) ) 
                                {
                                        $rss = "Enter a rss feed";
				
                                }
					
				$linkdata =classes::getallclass($cid,$id);
                                
				$smarty->assign("rss", $rss);
				$smarty->assign("user", $r);
				$smarty->assign("data", $linkdata);
				$smarty->assign("courseid", $cid);
                                $smarty->display("admin.tpl");
			}
		}else
		{
			die("Not logged in");
		}
	}
}
?>

