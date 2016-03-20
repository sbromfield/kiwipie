{extends file="base.tpl"}

{block name=content}
{foreach from=$data item=d}
<center><h2>{$d.title|escape:'htmlall'}</h2></center>
{/foreach}
<div id='playerdFxXzXHNSAbE'></div>
<script type='text/javascript'>
    jwplayer('playerdFxXzXHNSAbE').setup({
	{foreach from=$data item=d}
        playlist: [{
        image: 'https://mediaportal.fiu.edu/imgs/logo.jpg',
        sources:[
        { file: '{$url|escape:'htmlall'}{$d.url|escape:'htmlall'}' },
        { file: '{$murl|escape:'htmlall'}{$d.url|escape:'htmlall'}/playlist.m3u8' }	
	]
        }],
        {/foreach}
	width: '100%',
        autostart: 'true',
	aspectratio: '16:9'
	});
</script><br>
<div id="bookmarks">
<center><h1>Bookmarks</h1>
{foreach from=$books item=b}
<div style="float:left">
<center>
<a href="#" onclick="seek({$b.num|escape:'htmlall'})">
<img width="210" src="{$b.url|escape:'htmlall'}">
</a>
<br>
{$b.label|escape:'htmlall'}:00
</center>
</div>
{/foreach}
<script type='text/javascript'>
function seek(time){
time=time*60;
jwplayer('playerdFxXzXHNSAbE').seek(time);
}
</script>
</center>
</div>
{/block}
