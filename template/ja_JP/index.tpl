<ul>
{foreach from=$app.pages item=page}
<li><a href="?mypage={$page}"><tt>{$page}</tt></a></li>
{/foreach}
</ul>
