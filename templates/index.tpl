{extends file="base.tpl"}

{block name=content}

<h4>My Courses:</h4>	
<ul>
{foreach from=$data item=d}
        <li><a href="?action=viewvideo&course={$courseid}&video={$d.id}">{$d.title|escape:'htmlall'} </a>  </li>
{/foreach}
</ul>

{/block}
