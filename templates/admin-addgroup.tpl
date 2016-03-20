{extends file="adminbase.tpl"}

{block name=content}		
		<center>
		
		<form method="POST" action="?action=adminaddgroup">

		Pick a Course:<br>
 		<select id="course" name="course">
		{foreach $classes as $c}
			<option value="{$c.id}">{$c.name|escape:'htmlall'} </option>
		{/foreach}
		</select>
		<br>
		User Ids:<br>
		<textarea id="pid" name="pid">  </textarea>
		
		<br>
                Confirm 
                <input type="checkbox" id="confirm" name="confirm">
                <br>
		<br>
		<input type="submit" value="Submit">
		</form>

		</center>
{/block}
