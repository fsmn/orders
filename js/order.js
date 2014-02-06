$(document).ready(function(){

	
	
	$("#listOrders").live('click',function(event){
	});// end listOrders.click
	
	
	
	$(".view_orders").live('click',function(event){
		var kVendor=this.id.split("_")[1];
		viewVendorOrders(kVendor);
	});
	
	
	$('.print_order').live('click',function(event){
			var myPO=this.id.split("_")[1];
			document.location = baseUrl + "order/view/" + myPO + "/print";
	});
	
	
	$(".view_order").live('click', function(event){
			var kPO = this.id.split("_")[1];
			viewOrder(kPO);
	});
	
	
	$('.delete_order').live('click',function(event){
		 action=confirm("Are you sure you want to delete this? This cannot be undone!");
		    if(action==true){
		        realAction=confirm("Are you absolultely, positively sure you want to delete this?");
		        if(realAction==true){
		        	var myPO=this.id.split('_')[1];
		        	var myVendor = this.id.split('_')[2];
		        	var formData = {
						kPO: myPO,
						kVendor: myVendor,
						ajax: 1
		        	};
		        	
					var myUrl = baseUrl + "order/delete";
		        	
					$.ajax({
						url: myUrl,
						type: 'POST',
						data: formData,
						success: function (data){
						document.write(data);
					}
					});
					//document.location = baseUrl + "order/vendor_orders/" + myVendor;
		       }
		    }
	});
	
	
	$('.new_order').live('click',
			function(event){
				var myVendor = this.id.split("_")[1];
				var formData = {
						ajax: '1'
				};
				
				var myUrl = baseUrl + "order/add/" + myVendor;
				$.ajax({
					url: myUrl,
					type: 'POST',
					data: formData,
					success: function(data) {
					showPopup('Add Order', data, 'auto');
					$(".datefield").datepicker();

					}
				});
		}// end function(event)
	);// end newOrderButton.click
	
	
	$('.editOrder').live('click',
			function(event){
				var myOrder=this.id.split("_")[1];
				var formData = {
						ajax: '1'		
				};
				var myUrl = baseUrl + "order/edit/" + myOrder;
				$.ajax({
					url: myUrl,
					type: 'POST',
					data: formData,
					success: function(data) {
					showPopup('Edit Order', data, 'auto');
					$(".datefield").datepicker();

					}
				});
				
			} // end function(event)
	); // end editOrder
	
	
	$('.order_search').live('click',function(event){
		var myUrl = baseUrl + "order/show_search/";
		var formData = {
				ajax: '1'
		};
		$.ajax({
			url: myUrl,
			type: 'POST',
			data: formData,
			success: function(data) {
			showPopup('Search for Order Totals',data,'auto');
			$(".datefield").datepicker();
			$("#startDate").blur();
		}
		});
	});
	
	

	
});