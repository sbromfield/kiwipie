<?php
require_once 'boot.php';	
	

	if(empty($_GET['action'])){
		$myindex = new indexcontroller();
		$myindex->display();
	}else{

		if(class_exists($_GET['action']."controller")){
			$class = $_GET['action']."controller";
			$run = new $class;
			$run->display();
		}else{
			//global $smarty;
			//$smarty->display('404.html');
			echo "404";
		}
	}
 
//auth::login("","");
//var_dump($_GET);	
//var_dump($_POST);	
?>
