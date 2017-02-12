<?php
require_once 'boot.php';

$course = classes::getallcourses();
foreach($course as $c)
{
$courseid = $c['id']."<br>";
$courseurl = $c['url'];
echo $courseid;

global $rss;
//var_dump($rss);

$result = $rss->get($courseurl);
if($result == NULL)
{
	continue;
}
$len = count($result['items']) - 1;
echo $len;

for($i = $len ; $i > -1; $i--)
{
	$items = "https:".substr($result['items'][$i]['link'], 6);
	$strip = explode("info=",$items);
	$classes = rawurldecode(_MEDIAURL.trim($strip[1]));	

	$classtitle = $result['items'][$i]['title'];
	
	$date = $result['items'][$i]['pubDate'];
	$r = strpos($date, ":");
	$date = substr($date, 0, $r - 3); 
	$d = DateTime::createFromFormat("D, d M Y", $date);
	
	//echo $d->format("Y-m-d H:i:s"). "<br>";
	
	$doc = new DOMDocument();
	$doc->load($classes);

	$avtag = $doc->getElementsByTagName('AVFile');
	$l = $avtag->item(0)->getElementsByTagName('Location');

	$books = $doc->getElementsByTagName('Bookmarks');
	$book = $books->item(0)->getElementsByTagName('Bookmark');
	$numbooks =  $book->length;

	foreach($l as $location)
	{
         	$video = $location->nodeValue;
	}
	
	$all = classes::getclasses($courseid,$video);
	if($all == NULL)
	{	
		classes::insertclass($video, $classtitle, $courseid, $numbooks, $d->format("Y-m-d H:i:s") );
	}	
}


}


?>
