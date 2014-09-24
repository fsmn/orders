<?php

foreach($vendors as $vendor){
	$output[] = "<fieldset class='vendor-list'><legend>$vendor->vendorName</legend>";
	$output[] = "<p><span class='button edit edit_vendor' id='edit_$vendor->kVendor'>Edit</span>&nbsp;";
	$output[] = sprintf("<a class='button' href='%s'>Orders</a>",site_url("order/vendor_orders/$vendor->kVendor"));
	$output[] = "<span class='new_order new button' id='new_$vendor->kVendor'>New Order</span></p>";
	$output[] = "</fieldset>";
}
echo $links;
echo join("\r", $output);

