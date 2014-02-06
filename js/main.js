$(document).ready(function(){
	$('.go_back').live('click',function(event){
		history.back(2);
	});
	

	$("#printPage").live('click',function(event){
		printPage();
		event.preventDefault();
	});// end printPage.click
	
	
	$("#editPage").live('click',function(event){
		var kPO=$('.poBox').html();
		document.location="index.php?target=order&action=showOrder&kPO="+ kPO;
	});// end editPage.click


});



function showPopup(myTitle,data,popupWidth,x,y){
	if(!popupWidth){
		popupWidth=300;
	}
	var myDialog=$('<div></div>').html(data).dialog({
		autoOpen:false,
		title: myTitle,
		modal: true,
		width: popupWidth
	});
	
	if(x) {
		myDialog.dialog({position:x});
	}


	myDialog.fadeIn().dialog('open',{width: popupWidth});
	
	return false;
}


function validatePO(myPO, myUrl, myTarget)
{
	var formData = {
			ajax: 1
	};
	
	$.ajax({
		url: myUrl,
		type:'POST',
		data: formData,
		success: function(data){
			$('#' + myTarget).html(data);
		}
		
	}); //end ajax
} //end validatePO

function showOtherField(sourceId, targetSpan, fieldSize) {
	var myValue = $("#" + sourceId).val();
	if(myValue == "other") {
		var myValue = $('#' + targetSpan).html();
		$('#' + targetSpan).html("<input type='text' name='" + sourceId + "' id='" + sourceId + "'/>");
		$("#" + sourceId).focus();
	}
}


function viewOrder(kPO){
    document.location = baseUrl + "order/view/" + kPO;
}


function printPage(){
    window.print();
}


function updateTotal(myCost, myCount) {
	myTotal = myCost * myCount;
	document.getElementById('itemTotal').value = myTotal;

}

function viewVendorOrders(kVendor){
	document.location =   baseUrl  + "order/vendor_orders/" + kVendor; 
}


function viewVendor(kVendor){
    document.location = baseUrl + "vendor/view/"+ kVendor;
}

