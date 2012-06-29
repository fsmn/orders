<?php
?>

<form name="item_search" id="item_search" action="<?=site_url("item/find/")?>" method="post">
<p><label for="search_string">Text to search for in item numbers and descriptions</label></p>
<p>
<input type="text" name="search_string" id="search_string" value=""/></p>
<p>
<input type="submit" value="Search"/>
</p>
</form>