{extends file="adminbase.tpl"}

{block name=content}		
		<center>
		
		<form method="POST" action="?action=adminhidevideo">
		
		<font size="5">Hide Classes</font><br>
		<br>Course name:<br>
		<select name="course">
		{foreach from=$courses item=course}
		<option value="{$course.id}">{$course.name|escape:'htmlall'}</option>
		{/foreach}
		</select>
		<br>
		<input type="submit" name="query" value="Query"><br><br>
		<form method=POST" action"?action=adminhidevideo">
		<font size="4">Classes:</font><br><br>
		{foreach from=$classes item=class}
		<input type="checkbox" name="class[]" value="{$class.id|escape:'htmlall'}"  />
		{$class.title|escape:'htmlall'} &nbsp;
		{if $class.hide eq 1}
		(Hidden)
		{/if}
		<br>
		{/foreach}		
		<br><input name="confirm" type="checkbox" value="True">Confirm Delete
		<br>
		<input type="submit" name="submit" value="Submit">
		</form>
{/block}
