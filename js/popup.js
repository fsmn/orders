
$("#kPO").live('blur', function(event) {
		var myPO = this.value;
		var myUrl = baseUrl + "order/has_match/" + myPO;
		var myTarget = "validPO";
		validatePO(myPO, myUrl, myTarget);
	}// end function(event)
	);// end kPO.blur();
		
	
	$("#newPO").live('blur',function(event) {
		var myPO = this.value;
		var myUrl = baseUrl + "order/has_match/" + myPO;
		var myTarget = "validNewPO";
		validatePO(myPO, myUrl, myTarget);
	}// end function(event)
	);// end kPO.blur();
		
		
	$('#poOrderMethod').live('mouseup',
		function(event){
			showOtherField('poOrderMethod', 'orderMethodView');
		}// end function(event)
	);// end live('change',kVendor);
	
	
	$("#poPaymentType").live('mouseup',function(event){
		showOtherField("poPaymentType", "paymentTypeView");
	});
	
	
	$("#poCategory").live('mouseup',function(event){
		showOtherField("poCategory", "categoryView");
	});
	
	$("#insertDate").live('click',function(event) {
		var theDate = new Date();
		var year = theDate.getFullYear();
		var month = theDate.getMonth() + 1;
		var day = theDate.getDate();
		day = ((day < 10) ? "0" : "") + day;
		var dateString = year + "-" + month + "-" + day;
		$('#poDate').val(dateString);
	});// end insertDate.click
		
	