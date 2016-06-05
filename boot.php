<?php
	//error reporting
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	//defines
	//_SBASE is the location of the compiled smarty template files
	define("_SBASE", "");
	//key and secret are the LTI parameters
	define("_KEY", "");
	define("_SECRET", "");
	//Web address of the applaction index
	define("_ROOT_", "");
	//local path to application folder
	define("_BASE", "");
	define("__smartypath__", _BASE."/libs");
	//Database infomation
	//Database host
	define("_DBHOST", "");
	//Database user
	define("_DBUSER", "");
	//Database passwod
	define("_DBPASS", "");
	//Database name
	define("_DBNAME", "");

	//wowza rmtp video on demand url
	define("_NETURL", "");
	//wowza HLS video on demand url
	define("_MNETURL", "");
	//url where all bookmarks are
	define("_BOOKURL", "");
	define("_MEDIAURL","");
	//requires
	require_once __smartypath__."/smarty.class.php";
	require_once __smartypath__."/lastRss.php";

	//template stuff
	$smarty = new Smarty();
	$smarty->setTemplateDir(_BASE.'/templates');
	$smarty->setCompileDir(_SBASE.'/smarty/compile');
	$smarty->setCacheDir(_SBASE.'/smarty/cache');
	$smarty->setConfigDir(_SBASE.'/smarty/configs');

	//load all controllers
	require_once _BASE."/controllers/indexcontroller.php";
	require_once _BASE."/controllers/viewvideocontroller.php";
	require_once _BASE."/controllers/rsscontroller.php";
	require_once _BASE."/controllers/countcontroller.php";
	require_once _BASE."/controllers/hidevideocontroller.php";
	require_once _BASE."/controllers/unhidevideocontroller.php";

	require_once _BASE."/classes/auth.php";
	require_once _BASE."/classes/sessionmanager.php";
	$authclass = "ltiauth";
	$sessionclass = "ltisession";
	require_once _BASE."/classes/ltisession.php";
	require_once _BASE."/classes/ltiauth.php";
	require_once _BASE."/classes/dbcore.php";
	//models
	require_once _BASE."/models/classes.php";
	require_once _BASE."/models/user.php";
	require_once _BASE."/models/groups.php";

	$db = dbcore::getInstance();


	//rss
	$rss = new lastRSS;
	//local path to a directory for the rss cache
	$rss->cache_dir = '/tmp';
	$rss->cache_time = 1200;

	$roles = Array('Instructor');
?>
