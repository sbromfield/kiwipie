<?php
class groups
{

	public static function getgroups($pid)
	{
		global $db;

		$sql = "select g.id, g.userid, g.courseid, c.name from mygroup g, course c where c.id = g.courseid and userid = :pid";
		$st = $db->prepare($sql);

		$st->execute(array(":pid"=> $pid));
		$r = $st->fetchAll();

		return $r;		
	}

	public static function addgroup($pids, $course)
	{
		global $db, $adminids;
		$db->beginTransaction();

		$sql = "insert into mygroup(userid, courseid) values(:pid, :course)";
		$st = $db->prepare($sql);

		
		$ids = self::parseid($pids);
		$ids = array_merge($ids,$adminids);
		foreach($ids as $id)
		{
			$st->execute(array(":pid"=>$id,":course" => $course));			
		}

		$db->commit();
	
	}
	
	public static function parseid($ids)
	{
		$r = array();

		if(is_array($ids))
		{
			foreach($ids as $id)
			{
				if(is_numeric($id))
				{
					array_push($r, $id);
				}				
			}
			return $r;
		}else
		{
			$temp = explode(",", $ids);
	
			foreach($temp as $id)
			{
				if(is_numeric($id))
				{
					array_push($r, $id);
				}
				
			}
			return $r;
		}


	}
}
?>
