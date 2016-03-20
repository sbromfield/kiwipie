<?php
class user
{
	public static function ispresent($studentid)
	{
		global $db;

		$sql = "select id from users where studentid = :id";
		$st = $db->prepare($sql);
		$st->execute(array(":id"=> $studentid));
		$r = $st->fetch();

		return gettype($r) == "boolean" ? False : True;
	}

	public static function getuserid($studentid)
	{
		global $db;
		$sql = "select id from users where studentid = :id";

		$st = $db->prepare($sql);
	 	$st->execute(array(":id" => $studentid));
		$r = $st->fetch();		
		if( gettype($r) == "boolean")
		{
			return "fail";
		}
		return $r[0];
	}

	public static function insertstudent($id)
	{
		global $db; 
	
		$sql = "insert into users(studentid) values(:sid)";
		$st = $db->prepare($sql);
		$r = $st->execute(array(":sid" => $id));

		return $r;
	}

	public static function isingroup($userid, $courseid)
	{
		global $db;
		$sql = "select count(id) as count from mygroup where userid= :uid and courseid = :cid";

		$st = $db->prepare($sql);
		$st->execute(array(":uid"=>$userid, ":cid" => $courseid));
		$r = $st->fetch();

		if($r['count'] > 0)
		{
			return True;
		}

		return False;
	}

	public static function register()
	{
		global $db;
		$sql = "insert into mygroup(courseid, userid) values(:cid, :uid)";
		$sql2 = "insert into course(name) values(:name)";
		//if the session is alive move ahead
		if(session_id() != "")
		{
			//check if user is in db
			 if(!user::ispresent($_SESSION['userid']))
                        {
                                user::insertstudent($_SESSION['userid']);
                        }
			//check if course is in the db
			if(!classes::ispresent($_SESSION['courseid']))
			{
				$st = $db->prepare($sql2);
                		$r = $st->execute(array(":name"=>$_SESSION['courseid']));
			}
			//var_dump( user::ispresent($_SESSION['userid']));
			//die(user::ispresent($_SESSION['userid']));
			$cid = classes::getcourseid($_SESSION['courseid']);
			$sid = user::getuserid($_SESSION['userid']);
			//if user is not in the course, register them
			if(user::isingroup($sid,$cid) == False)
			{
				$st = $db->prepare($sql);
                		$r = $st->execute(array(":cid"=>$cid, ":uid"=> $sid));
			}
		}
	}
}
?>
