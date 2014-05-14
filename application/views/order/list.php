<?php
$listing = array();
$lastVendor = 0;
if (count($orders)> 0 ){
	foreach($orders as $order){
		if( $lastVendor != $order->kVendor){
			$row["header"]["vendor"] = "<span id='v_$order->kVendor;'>$order->vendorName</span>";
			$row["header"]["button"] = "<span class='button new new_order' id='new_$order->kVendor'>New Order</span>";
			$lastVendor = $order->kVendor;
			$vendor_total = 0;
		}
		$total = getAsCash($order->poTotal);
		$item = array();
		$item[] = "<strong>$order->kPO</strong>";
		$item[] = formatDate($order->poDate, 'standard');
		$item[] = $total;
		$item[] = "<a class='button' href='". site_url("order/view/$order->kPO") ."'>View</a>";
		$row["table"][] = "<tr><td>" . implode("</td><td>", $item) . "</td></tr>";
		$vendor_total += $order->poTotal;
	}
	$listing[] = $row;
}else{ ?>
<fieldset
	style='padding: 1em; margin: 20px; width: 50%; border: 1px black solid;'>
	<legend class='warning' style='padding: 5px'>There were no orders
		found.</legend>
	<p>This is probably because you chose to list orders for a vendor with
		no orders entered.</p>
	<p>
		<span class='button go_back'>Return</span>
	</p>
</fieldset>
<? }

foreach($listing as $entry): ?>
<fieldset>
	<legend>
		<?=$entry["header"]["vendor"];?>
	</legend>
	<div class='button-box'>
		<?=$entry["header"]["button"];?>
	</div>
	<table>
	<thead><tr><th>PO</th><th>Date</th><th>Total</th><th></th></tr></thead>
	<tbody>
	<? foreach($entry["table"] as $tr): ?>
	<? if($tr){ echo $tr;} ?>
	<? endforeach; ?>
	</tbody>
	
	</table>
	<p>Grand Total: <strong><?=getAsCash($vendor_total);?></strong></p>
</fieldset>
<? endforeach;