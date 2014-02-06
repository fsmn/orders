<?php

?>
<form id="order_editor" action="<?=site_url("order/$action"); ?>"
	method="post" name="order_editor">
<p><label for="kVendor">Change Vendor: </label> <span id="vendorView"><?=form_dropdown('kVendor', $vendorPairs, getValue($order, 'kVendor', $kVendor), 'id="kVendor"');
?></span></p>
<?php if($action == "update"):?>
<p><label for="kPO">Purchase Order: </label><input type="text"
	name="kPO" id="kPO" readonly style="width: 4em"
	value="<?=getValue($order, 'kPO'); ?>"/> <span id="validPO"></span></p>
<p><label for="newPO">New Purchase Order#: </label><input type="text"
	name="newPO" id="newPO" style="width: 4em"
	value="<?=getValue($order, 'kPO'); ?>"/> <span id="validNewPO"></span></p>
<?php else: ?>
<p><label for="kPO">Purchase Order: </label><input type="text"
	name="kPO" id="kPO" style="width: 4em"
	value="<?=getValue($order, 'kPO'); ?>"/> <span id="validPO"></span></p>

<?php endif;?>
<p><label for="poDate">Order Date</label> <input type="text" class="datefield"
	name="poDate" id="poDate" style="width: auto;"
	value="<?=formatDate(getValue($order, 'poDate'),"standard");?>"/> <a id="insertDate">&lt;-Today</a></p>
<p><label for="poOrderMethod">Order Method: </label><span
	id="orderMethodView"> <?php 
	echo form_dropdown('poOrderMethod', $methodPairs, getValue($order, 'poOrderMethod'), 'id="poOrderMethod"');
	?></span></p>
<p><label for="poPaymentType">Payment Type: </label><span
	id="paymentTypeView"> <?php 
	echo form_dropdown('poPaymentType', $typePairs, getValue($order, 'poPaymentType'), 'id="poPaymentType"');
	?></span></p>
<p><label for="poOrderedBy">Ordered By: </label><input type="text"
	name="poOrderedBy" id="poOrderedBy" style="width: auto;"
	value="<?=getValue($order, 'poOrderedBy'); ?>"/></p>

<p><label for="poBillingContact">Billing Contact: </label><input
	type="text" name="poBillingContact" id="poBillingContact"
	style="width: auto;"
	value="<?=getValue($order, 'poBillingContact', 'Garth Morrisette'); ?>"/></p>
<p></p>
<p><label for="poCategory">Order Category: </label> <span
	id="categoryView"> <?=form_dropdown('poCategory', $categoryPairs, getValue($order, 'poCategory'), 'id="poCategory"');
	?> </span></p>
<p><label for="poQuote">Vendor Quote Number: </label> <input type="text"
	name="poQuote" id="poQuote" style="width: auto;"
	value="<?=getValue($order, 'poQuote')?>"/></p>
<p><input type="submit" class="save_order" value="Save" />

</form>
