<?php

class classes
{

        public function __construct()
        {

        }

        public static function insertcourses($name, $url)
        {
                global $db;

                $sql = "insert into course(name, url) values(:name, :url)";

                $st = $db->prepare($sql);
                $r = $st->execute(array(":name"=>$name, ":url"=> $url));
                return $r;
        }


	public static function getrsslink($courseid)
	{
		global $db;

		$sql = "select url from course where id = :id";

		$st = $db->prepare($sql);
		$st->execute(array(":id" => $courseid));
		$r = $st->fetchAll();

		if( is_null($r[0]["url"]) )
		{
			return False;
		}
		

		return $r[0]["url"];
	}


	public static function unhidevideo($videoid, $courseid)
        {
                global $db;

                $sql = "update class set hide = 0 where id = :id and courseid = :cid";

                $st = $db->prepare($sql);
                $r = $st->execute(array(":id" => intval($videoid), ":cid" => intval($courseid)));

                return $r;
        }


	public static function updatecount($courseid, $count)
	{
		global $db;

		$sql = "update course set display = :c where id = :cid";
		$st = $db->prepare($sql);
		$r = $st->execute(array(":c" => intval($count), ":cid" => intval($courseid)));

		return $r;
	}

	public static function getcount($courseid)
	{
		global $db;

		$sql = "select display from course where id = :cid";
		$st = $db->prepare($sql);
		$st->execute(array("cid"=>intval($courseid)));
		$r = $st->fetchall();

		return $r[0]["display"];
	}

	public static function hidevideo($videoid, $courseid)
	{
		global $db;

		$sql = "update class set hide = 1 where id = :id and courseid = :cid";

		$st = $db->prepare($sql);
		$r = $st->execute(array(":id" => intval($videoid), ":cid" => intval($courseid)));
		
		return $r;	
	}
	
	public static function updatecourse($id, $url)
	{
		global $db;

                $sql = "update course set url=:url where id=:id";

                $st = $db->prepare($sql);
                $r = $st->execute(array(":id"=>$id, ":url"=> $url));
                return $r;
	}

/*	public static function getallcourses()
	{
		global $db;

		$sql = "select name, id from course";
		$st = $db->prepare($sql);
		$st->execute();

		return $st->fetchAll();
	}

*/

	public static function getallcourses()
        {
                global $db;

                $sql = "select name, id,url from course";
                $st = $db->prepare($sql);
                $st->execute();

                return $st->fetchAll();
        }

	public static function getclasses($classid, $url)
        {
                global $db;
                $sql = "select id,url from class where courseid = :courseid and url = :url order by id asc";
                $st = $db->prepare($sql);
                $st->execute(array(":courseid"=> $classid,":url"=> $url ));

                return $st->fetchAll();
        }




	public static function insertclass($url, $title, $courseid, $bookmark)
        {
                global $db;

                $sql = "insert into class(url,title,courseid,bookmark) values(:url,:title,:courseid,:bookmark)";
                $st = $db->prepare($sql);
                $r = $st->execute(array(":url"=>$url, ":title"=> $title, ":courseid"=> $courseid, "bookmark"=> $bookmark));
                return $r;
        }


	public static function howmanyclassestodisplay($courseid)
	{
		global $db;

		$sql = "select display from course where id = :id";
		$st = $db->prepare($sql);
		$st->execute(array(":id" => intval($courseid)));
		$r = $st->fetchAll();
		return intval($r[0]['display']);
	}		


	public static function getclass($courseid, $pid)
	{
		global $db;
	
		$count = classes::howmanyclassestodisplay($courseid);
		$cid = intval($courseid);
	
		if($count == -1)
		{
			$sql = "select distinct id, url, title from class where hide <> 1 and courseid = :courseid";
			$st =$db->prepare($sql);
			$st->execute(array(":courseid"=> intval($courseid)) );
		}else
		{
			$sql = "select distinct id, url, title from class where hide <> 1 and courseid = :courseid limit :c";
			$st =$db->prepare($sql);
			$st->bindParam(':c', $count, PDO::PARAM_INT);
			$st->bindParam(':courseid', $cid, PDO::PARAM_INT);
			$st->execute();
		}

		return $st->fetchAll();
	}



	public static function getallclass($courseid, $pid)
        {
                global $db;
		
                $sql = "select distinct id, url, title, hide from class where courseid = :courseid";
                $st =$db->prepare($sql);
                $st->execute(array(":courseid"=> intval($courseid)) );

                return $st->fetchAll();
        }



	public static function getvideo($courseid, $pid, $video)
	{
		 global $db;

                $sql = "select c.id, c.url, c.bookmark, c.title from class as c,mygroup as g where g.userid = :pid and c.id = :videoid  and g.courseid = c.courseid and c.courseid = :courseid";
                $st =$db->prepare($sql);
                $st->execute(array(":videoid"=>intval($video), ":courseid"=> intval($courseid), ":pid" => intval($pid)));

                return $st->fetchAll();
		
	}

	public static function getcoursetitle($courseid)
	{
		global $db;

		$sql = "select name from course where id = :courseid";
                $st =$db->prepare($sql);
                $st->execute(array(":courseid"=> intval($courseid)));

                return $st->fetchAll();
	}

	public static function getcourseid($context)
	{
		global $db;
		$sql = "select id from course where name = :name";
		$st = $db->prepare($sql);
		$st->execute(array(":name"=> $context));
	
		$r = $st->fetchAll();
		return $r[0]['id'];
	}

	public static function ispresent($courseid)
	{
		global $db;

		$sql = "select id from course where name = :id";

		$st = $db->prepare($sql);
		$st->execute(array(":id" => $courseid));
		$r = $st->fetch();
	
		return gettype($r) == "boolean" ? False : True;
	}



	public static function getBookmarks($video,$bookurl)
        {
        	$b = $video['bookmark'];
        	$a = -1;
        	$baseurl = $video['url'];
        	$baseurl = explode('mp4:',$baseurl);
        	$baseurl = explode('MPEG-4-HD',$baseurl[1]);
        	for($i=0; $i < $b; $i++)
                {
        	        $ii = substr($i,-2);
                	if($ii<60)
                        {
                        	$a++;
                        	$hour = ($a/60);
                        	$hour = explode('.',$hour);
                        	if($i<10){
                        	        $url = $bookurl.$baseurl[0]."000".$i."00.png";
                //              echo $url."<br>";       
                                	$min = $a;
                                }
                        	else if($i<60 and $i>9){
                                	$url = $bookurl.$baseurl[0]."00".$i."00.png";
                                	$min = $a;
                //              echo $url."<br>";
                        	}
                        else {
                                $url = $bookurl.$baseurl[0]."0".$i."00.png";
                                $min = $a-($hour[0]*60);
                //              echo $url."<br>";
                             }
                        if ($min<10) $min="0".$min;
                        $book = $hour[0].":".$min;
                        $div[$a]['url'] = $url;
                        $div[$a]['label'] = $book;
                        $div[$a]['num'] = $a;
                        //echo $book."<br>";     

                        }
                else {
                	$b++;
                }
        }
        return $div;
        }

}

?>
