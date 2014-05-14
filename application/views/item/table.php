<?php
if($target == "item/table"):?>
<h2>Showing search results for "<?=$search_string?>"</h2>

<?php endif; ?>
<table class="order" >
	<thead>
		<tr>
			<td style="width: .25in">CT</td>
			<td style="width: .75in">Item#</td>
			<td style="width: 3in">Description</td>
			<td style="width: 1in">Category</td>
			<td style="width: .75in">Price</td>
			<td style="width: .75in">Total</td>
			<?php if($print != true): ?>

			<td class="clear"></td>
			<td class="clear"></td>
			<?php elseif($target == "item/table"):?>
			<td></td>
			<?php endif; ?>

		</tr>
	</thead>
	<?php
	$grandTotal = 0;
	if(!empty($items)):
		foreach($items as $item):
	
			$total=strval($item->itemCount)*strval($item->itemPrice);  ?>
	
		<tr class="<?=$class?>" id="itemRow_<?=$item->kItem?>">
			<td><?=$item->itemCount?></td>
			<td><?=$item->itemNumber?></td>
			<td><?=$item->itemDescription?></td>
			<td><?=$item->itemCategory?></td>
			<td style="text-align: right"><?=getAsCash($item->itemPrice)?></td>
			<td style="text-align: right"><?=getAsCash(strval($item->itemCount)*strval($item->itemPrice))?></td>
	
			<?  $grandTotal+=$total;
			if( $print ):
			echo "</tr>";
			elseif($target == "item/table"): ?>
			<td><a href="<?=site_url("order/view/$item->kPO");?>" title="show order"
				>View Order #<?=$item->kPO?></a></td>
				<? else: ?>
			<td class="clear"><span class="edit_item edit button"
				id="editItem_<?=$item->kItem; ?>">Edit</span></td>
			<td class="clear"><span class="button delete_item delete"
				id="item_<?=$item->kItem. "_" . $item->kPO; ?>">Delete</span></td>
		</tr>
	
		<? endif;
		endforeach; 
		 endif; ?>
		 <tr>
        <td style="text-align: right" colspan="6">Total: <span
            id="total_<?=$kPO?>"><?=getAsCash($grandTotal)?></span></td>
    </tr>
	
</table>
