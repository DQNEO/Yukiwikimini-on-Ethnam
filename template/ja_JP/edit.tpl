    {form ethna_action="write"}
        <input type="hidden" name="action_write" value="true">
        <input type="hidden" name="mypage" value="{$form.mypage}">
        <input type="submit" value="Write"><br />
        <textarea cols="80" rows="20" name="mymsg" wrap="off">{$app.content}</textarea><br />
        <input type="submit" value="Write">
    {/form}

