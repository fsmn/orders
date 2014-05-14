<?php
$itemCount = getValue($item, 'itemCount', 0);
$itemPrice = getValue($item, 'itemPrice', 0);
$itemTotal = getAsCash(strval($itemCount) * strval($itemPrice));

?>
<form id="item_editor" action="<?=site_url("item/$action")?>"
	method="post" name="item_editor"><input type="hidden" name="kItem"
	id="kItem" value="<?=getValue($item, 'kItem')?>"> <input type="hidden"
	name="kOrder" id="kOrder" value="<?=getValue($item, 'kOrder'); ?>"> <label
	for="kPO">PO:<?=$kPO?> </label> <input type="text" name="kPO" id="kPO"
	style="width: 4em" value="<?=getValue($item, 'kPO', $kPO);?>">
<p><label for="itemCount">Count: </label><input type="text"
	name="itemCount" id="itemCount" style="width: 3em"
	value="<?=getValue($item, 'itemCount');?>"></p>
<p><label for="itemNumber">Item Number:</label><input type="text"
	name="itemNumber" id="itemNumber" style="width: auto"
	value="<?=getValue($item, 'itemNumber'); ?>"></p>
<p><label for="itemDescription">Description: </label> <textarea
	id="itemDescription" name="itemDescription"
	style="width: auto; height: 70px; scrollbar: auto"><?=getValue($item, 'itemDescription');?></textarea></p>
<p><label for="itemCategory">Category: </label> 
<span id="categoryDiv">
<?=form_dropdown('itemCategory', $categoryPairs, getValue($item, 'itemCategory'), 'id="itemCategory"');?>
</span>
</p>
<p><label for="itemPrice">Unit Price: $</label> <input type="text"
	name="itemPrice" id="itemPrice" style="width: 5em"
	value="<?=getValue($item, 'itemPrice')?>"></p>
<p><label for="itemTotal">Total: </label> <input type="text"
	name="itemTotal" readonly id="itemTotal" style="width: 5em"
	value="<?=$itemTotal?>"></p>
</form>
<p><input type="submit" class="button save_item <?=$action;?>" value="<?=ucfirst($action);?>" /></p>

