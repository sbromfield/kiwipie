{extends file="adminbase.tpl"}

{block name=content}		
		<center>
		
		<form method="POST" action="?action=admineditclass">

		Course name:<br>
		<select name="class">
		{foreach from=$classes item=class}
		<option value="{$class.id}">{$class.name|escape:'htmlall'}</option>
		{/foreach}
		</select>
		<br>

		RSS url:<br>
		<input type="text" name="rss">
		<br>
		<input name="confirm" type="checkbox" value="Ture">Confirm
		<br>
		<input type="submit" value="Submit">
		</form>
{/block}
