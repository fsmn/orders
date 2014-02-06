$(".new_vendor").live('click',
		function(event){
			var formData = {
				ajax: 1,
				action: "add"
			};
			var myUrl = baseUrl + "vendor/add/";
			$.ajax({
				url: myUrl,
				type: 'POST',
				data: formData,
				success: function(data) {
				showPopup("New Vendor", data, 'auto');
			}
			});
		}// end function(event)
	);// end newVendor.click
	

	
$('.edit_vendor').live('click',
		function(event){
			var myVendor=this.id.split("_")[1];
			var formData = {
					ajax: '1'		
			};
			var myUrl = baseUrl + "vendor/edit/" + myVendor;
			$.ajax({
				url: myUrl,
				type: 'POST',
				data: formData,
				success: function(data) {
				showPopup('Edit Vendor', data, 'auto');
				}
			});
			
		} // end function(event)
); // end edit_vendor
		
	
$("#showAllVendors").live('click',function(event){
	document.location = baseUrl + "vendor/";
	event.preventDefault();
});// end showAllVendors.click
	
	
$('.save_vendor').live('click', function(event){
	document.forms['vendor_editor'].submit();
});
