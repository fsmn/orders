<?php
if($target == "item/table"):?>
<h2>Showing search results for "<?=$search_string?>"</h2>

<?php endif; ?>
<table class="order" >
	<thead>
		<tr>
			<td class='count'>CT</td>
			<td class='item-number'>Item#</td>
			<td class='description'>Description</td>
			<td class='category'>Category</td>
			<td class='price currency'>Price</td>
			<td class='total currency'>Total</td>
			<?php if($target == "item/table"):?>
    			<td class='po-date'>Date</td>
    			<?php if($print != true): ?>
    			    <td class="kPO">Order</td>
    			<?php endif; ?>
    			<?php else:?>
    			<td class="clear"></td>
			<?php endif;?>


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
			<?php if($target == "item/table"):?>
<td><?=formatDate($item->poDate);?></td>
<?php endif;?>
			<?  $grandTotal+=$total;
			if( $print ):
			echo "</tr>";
			elseif($target == "item/table"): ?>
			<td><a href="<?=site_url("order/view/$item->kPO");?>" title="show order"
				><?=$item->kPO?></a></td>

				<? else: ?>
			<td class="clear"><ul class='button-box'><li><span class="edit_item edit"
				id="editItem_<?=$item->kItem; ?> title="edit item">Edit</span></li>
				<li>
				<span class="delete_item delete"
				id="item_<?=$item->kItem. "_" . $item->kPO; ?> title="delete item">Delete</span>
				</li>
				</ul></td>
		</tr>

		<? endif;
		endforeach;
		 endif; ?>
		 <tr>
        <td style="text-align: right" colspan="6">Total: <span
            id="total_<?=$kPO?>"><?=getAsCash($grandTotal)?></span></td>
    </tr>

</table>
