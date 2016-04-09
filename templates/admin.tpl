{extends file="base.tpl"}

{block name=content}
<center>
<form method="GET">
<input type="text" name="rss" value="{$rss}" style="width: 40%">
<input type="hidden" name="action" value="rss" style="width: 40%">
<input type="submit" value="submit">
</form>
<form method="GET">
<input type="hidden" name="action" value="count">
<label>The current video count is: {if $count == -1} unlimited.{else} {$count} {/if}</label>
<select name="values">
        <option value="-1">Show all Videos</option>
        <option value="1">Show 1 Video</option>
        <option value="2">Show 2 Video</option>
        <option value="3">Show 3 Video</option>
        <option value="4">Show 4 Video</option>
        <option value="5">Show 5 Video</option>
        <option value="6">Show 6 Video</option>
        <option value="7">Show 7 Video</option>
        <option value="8">Show 8 Video</option>
        <option value="9">Show 9 Video</option>
        <option value="10">Show 10 Video</option>

</select>
<input type="submit" value="submit">
</form>

</center>
<h4>My Videos:</h4>	
<ul>
{foreach from=$data item=d}
	{if $d.hide == 0}
        <li><a href="?action=viewvideo&course={$courseid}&video={$d.id}">{$d.title|escape:'htmlall'} </a> 
	<a href="?action=hidevideo&course={$courseid}&video={$d.id}">[ Hide Video ]</a>
	 </li>
	{else}
	<li><a href="?action=viewvideo&course={$courseid}&video={$d.id}">{$d.title|escape:'htmlall'} </a>
        <a href="?action=unhidevideo&course={$courseid}&video={$d.id}">[ Unhide Video ]</a>
         </li>
	{/if}

{/foreach}
</ul>

{/block}
