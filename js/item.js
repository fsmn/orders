$(document).ready(function(){

	$('.new_item').live('click', function(event){
			var myPO=$("#kPO").val();
			var formData = {
					ajax: '1',
					kPO: myPO
			};
			
			var myUrl = baseUrl + "item/add/";
			$.ajax({
				url: myUrl,
				type: 'POST',
				data: formData,
				success: function(data) {
				showPopup('Add Item', data, 'auto');
				}
			});
	});// end editItemButton.click
	
	
	$('.edit_item').live('click',
			function(event){
				var myItem=this.id.split("_")[1];
				var formData = {
						ajax: 1,
						kItem: myItem
				};
				var myUrl = baseUrl + "item/edit/";
				$.ajax({
					url: myUrl,
					type: 'POST',
					data: formData,
					success: function(data){
					showPopup('Edit Item', data, 'auto');
				}
				});
						
			}
	);// end editItemButton.click
	
	
	$("#itemCount").live('blur',function(event) {
		var price = $("#itemPrice").val();
		var ct = $(this).val();
		updateTotal(price, ct);
	});
	
	
	$("#itemPrice").live('blur',function(event) {
		var price = $(this).val();
		var ct = $("#itemCount").val();
		updateTotal(price, ct);
	});
	
	$(".item_search").live("click", function(event){
		var myUrl = baseUrl + "item/search";
		$.ajax({
			url: myUrl,
			type: 'GET',
			success: function(data){
			showPopup("Search for Items", data, "auto");
		}
		});
	});
		
	$('.save_item').live('click',
		function(event){
		document.forms['item_editor'].submit();
		}// end function(event)
	);// end addOrder.click
	
	
	$('.delete_item').live('click',function(event){
		var myID=this.id.split("_");
		var myItem=myID[1];
		var myPO=myID[2];
		 action=confirm("Are you sure you want to delete this? This cannot be undone!");
		    if(action==true){
		        realAction=confirm("Are you absolultely, positively sure you want to delete this?");
		        if(realAction==true){
					var formData = {
							kItem: myItem,
							kPO: myPO,
							ajax: '1'
					};
					var myUrl = baseUrl + "item/delete/";
					$.ajax({
						url: myUrl,
						type: 'POST',
						data: formData,
						success: function(data) {
						alert(data);
						document.location = document.location;
					}
					});
		      }
		    }
	});
	
	$("#itemCategory").live("change",function(event){
		if($("#itemCategory").val() == "other" ){
			$("#categoryDiv").html("<input type='text' name='itemCategory' id='itemCategory' value=''/>");
		}
	});

});