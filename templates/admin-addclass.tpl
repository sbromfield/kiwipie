{extends file="adminbase.tpl"}

{block name=content}

		<center>
		
		<form method="POST" action="?action=adminaddclass" enctype="multipart/form-data">
		<h2>Import Classes CSV:</h2>
		<input type="file" name="csvfile" id="csvfile">
		<br><br>{$error}
		<br><br>
		Course name:<br>
		<input type="text" name="cname">
		<br>

		RSS url:<br>
		<input type="text" name="rss">
		<br><br>
	
		<input type="submit" value="Submit">
		
		</center>
{/block}
