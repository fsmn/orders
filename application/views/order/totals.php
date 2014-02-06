<?php
$grandTotal = 0;
$lastPO = 0;
$orderLines[] = "<h1>Order Totals for $startDate through $endDate</h1>";
$orderLines[] = "<table class='order_list'>";
$notFirst = false;
$poTotal = 0;
$subTotals = array();
foreach($orders as $order){

	$orderLines[] = "<tr>";
	if($lastPO != $order->kPO){
		if($notFirst == true && $lastPO != $order->kPO){
			$orderLines[] = "<tr><td colspan='7' class='totals'>Order Total: " . getAsCash($poTotal). "</td></tr>";

		}
		$line = sprintf("<tr><td colspan='7' class='poLine'><a href='%s'>%s</a></td></tr>",site_url("order/view/$order->kPO"),$order->kPO);
		$orderLines[] = $line;
		$lastPO = $order->kPO;
		$notFirst = true;
		$poTotal = 0;
	}

	$orderLines[] = "<td>$order->itemCount</td>";
	$orderLines[] = "<td>$order->itemNumber</td>";
	$orderLines[] = "<td>$order->itemDescription</td>";
	$orderLines[] = "<td>$order->itemCategory</td>";
	$orderLines[] = "<td class='totals'>". getAsCash($order->itemPrice) . "</td>";
	$itemTotal = strval($order->itemCount)*strval($order->itemPrice);
	$orderLines[] = "<td class='totals'>".  getAsCash($itemTotal) ."</td>";
	$poTotal += $itemTotal;
	if(array_key_exists($order->itemCategory, $subTotals)){
		$subTotals[$order->itemCategory] += $itemTotal;
	}else{
		$subTotals[$order->itemCategory] = $itemTotal;
	}
	$grandTotal += $order->itemPrice * $order->itemCount;
}
$orderLines[] = "<tr><td colspan='7' class='totals'>Order Total: " . getAsCash($poTotal). "</td></tr>";

$orderLines[] = "<tr><td colspan='7' class='totals'>Grand Total: ". getAsCash($grandTotal). "</td></tr>";
$orderLines[] = "</table>";

$orderTable = join("\r", $orderLines);
$keys = array_keys($subTotals);
$values = array_values($subTotals);

$categoryLines[] = "<h1>Category Totals for $startDate through $endDate</h1>";
$categoryLines[] = "<table>";
for($i = 0; $i< count($subTotals); $i++){
	$key = $keys[$i];
	$value = $values[$i];
	$categoryLines[] = "<tr><td>$key</td><td>" . getAsCash($value). "</td></tr>";
}
$categoryLines[] =  "<tr><td colspan='2' class='totals'>Grand Total: ". getAsCash($grandTotal). "</td></tr>";
$categoryLines[] = "</table>";
$categoryTable = join("\r", $categoryLines);


switch($reportType){
	case "orders":
		echo $orderTable;
		break;
	case "categories":
		echo $categoryTable;
		break;
	default:
		echo "<div>$orderTable</div><div>$categoryTable</div>";
}


