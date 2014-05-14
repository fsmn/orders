<?php

foreach($vendors as $vendor){
	$output[] = "<fieldset class='vendor-list'><legend>$vendor->vendorName</legend>";
	$output[] = "<p><span class='button edit edit_vendor' id='edit_$vendor->kVendor'>Edit</span>&nbsp;";
	$output[] = "<span class='button view_orders' id='view_$vendor->kVendor'>Orders</span>&nbsp;";
	$output[] = "<span class='new_order new button' id='new_$vendor->kVendor'>New Order</span></p>";
	$output[] = "</fieldset>";
}
echo $links;
echo join("\r", $output);

