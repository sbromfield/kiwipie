{extends file="base.tpl"}

{block name=content}
<center>
<form method="GET">
<input type="text" name="rss" value="{$rss}" style="width: 40%">
<input type="hidden" name="action" value="rss" style="width: 40%">
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
