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
	$classes = rawurldecode("https://coursecapture.fiu.edu/CrestronMediaPlayer/".trim($strip[1]));	

	$classtitle = $result['items'][$i]['title'];
	
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
		classes::insertclass($video, $classtitle, $courseid, $numbooks);
	}	
}


}



?>
