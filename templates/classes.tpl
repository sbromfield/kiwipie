{extends file="base.tpl"}

{block name=content}

{if count($coursename) > 0}
	{foreach from=$coursename item=d}
	<h2>{$d.name|escape:'htmlall'}</h2> 
	{/foreach}
{/if}
	<ul>
{if count($data) > 0}
	{foreach from=$data item=d}
        	{if $d.hide eq 0}
		<li><a href="?action=viewvideo&course={$courseid}&video={$d.id}">{$d.title|escape:'htmlall'}</a></li>
		{/if}
	{/foreach}
{else}
	No Videos yet.
{/if}
</ul>
{/block}
