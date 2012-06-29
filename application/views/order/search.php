<?php
$startDate = "";
if (array_key_exists('startDate', $_COOKIE)) {
	$startDate = $_COOKIE['startDate'];
}

$endDate = "";
if (array_key_exists('endDate', $_COOKIE)) {
    $endDate = $_COOKIE['endDate'];
}
?>
<form id="order_search_form" action="<? echo site_url("order/find_records"); ?>" method="post" name="order_search_form">
<label for="startDate">Start Date</label><input type="text" id="startDate" name="startDate" value="<?php echo $startDate;?>" class="datefield"/>
<br/>
<label for="endDate">End Date</label><input type="text" id="endDate" name="endDate" value="<?php echo $endDate; ?>" class="datefield"/>
<br/>
<label for="reportType">Report Type</label><select id='reportType' name='reportType'>
<option value="all" selected>All</option>
<option value="categories">Category Totals</option>
<option value="orders">Order Totals</option>

</select>
<p>
<input type="submit" value="Search" class="order_find"/>

</p>
</form>


