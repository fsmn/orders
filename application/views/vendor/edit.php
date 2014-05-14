<?php
?>
<form name="vendor_editor" id="vendor_editor" action="<? echo site_url("vendor/$action"); ?>"
	method="post"> 
	<input type="hidden" name="kVendor"
	id="kVendor" value="<?php echo getValue($vendor, 'kVendor'); ?>"/>
<p><label for="vendorName">Vendor</label> <input type="text"
	name="vendorName" id="vendorName" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorName'); ?>"/></p>
<p><label for="vendorContact">Contact</label> <input type="text"
	name="vendorContact" id="vendorContact" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorContact'); ?>"/></p>
<p><label for="vendorAddress">Address</label> <textarea
	id="vendorAddress" name="vendorAddress"
	style="width: auto; height: 5ex"><?php echo getValue($vendor, 'vendorAddress'); ?></textarea></p>
<p><label for="vendorCityStateZip">City State &amp; Zip</label> <input
	type="text" name="vendorCityStateZip" id="vendorCityStateZip"
	style="width: auto" value="<?php echo getValue($vendor, 'vendorCityStateZip'); ?>"/></p>
<p><label for="vendorURL">URL</label> <input type="text"
	name="vendorURL" id="vendorURL" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorURL'); ?>"/></p>
<p><label for="vendorPhone">Phone</label> <input type="text"
	name="vendorPhone" id="vendorPhone" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorPhone'); ?>"/></p>
<p><label for="vendorFax">Fax</label><input type="text" name="vendorFax"
	id="vendorFax" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorFax'); ?>"/></p>
<p><label for="vendorEmail">Email</label> <input type="text"
	name="vendorEmail" id="vendorEmail" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorEmail'); ?>"/></p>
<p><label for="vendorCustomerID">Customer ID</label> <input type="text"
	name="vendorCustomerID" id="vendorCustomerID" style="width: auto"
	value="<?php echo getValue($vendor, 'vendorCustomerID'); ?>"/></p>
<p><input type="submit" class="button save_vendor <?=$action;?>" value="<?=ucfirst($action);?>"/></p>
</form>
