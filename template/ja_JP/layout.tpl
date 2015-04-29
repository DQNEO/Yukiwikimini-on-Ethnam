<html>
    <head>
      <title>{$app.title}</title>
      <style type="text/css">
        <!--
            {literal}
            body { font-family: "Courier New", monospace; }
            pre { line-height:130%; }
            a { text-decoration: none }
            a:hover { text-decoration: underline }
            {/literal}
          -->
      </style>
    </head>
    <body bgcolor="white">
        <table width="100%" border="0">
            <tr valign="top">
                <td>
                    <h1>{$app.title}</h1>
                </td>
                <td align="right">
                    <a href="?mypage=FrontPage">FrontPage</a> | 
                    {if $app.canedit}
                       <a href="?action_edit=true&mypage={$app.title}">Edit</a> | 
                    {/if}
                    <a href="?action_index=true">Index</a>
                </td>
            </tr>
        </table>
        {$content}
    </body>
</html>

