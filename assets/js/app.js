function changeDateFormat(userdate){
	const today = new Date(userdate);
	const yyyy = today.getFullYear();
	let mm = today.getMonth() + 1; // Months start at 0!
	let dd = today.getDate();
	
	if (dd < 10) dd = '0' + dd;
	if (mm < 10) mm = '0' + mm;
	
	const formattedToday = dd + '-' + mm + '-' + yyyy;
	
	return formattedToday;
}

function ValidateFormFields(FormId, FormClass='mandatory'){
    var error = 0;
	$('#'+FormId+' .'+FormClass).each(function() {
		if(!$(this).val()){
    		// $(this).css({'border-color': 'rgb(236 118 118)','outline': '0','box-shadow': 'rgb(250 1 1 / 20%) 0px 0px 0px 0.17rem'});
    		$(this).css({'border-color': '#FF5722','outline': '0'});
    		error = 1;
    	}else{
    		$(this).css('border-color','');
    		$(this).css('box-shadow','none');
    	}
    });
    
	if(error == 1){
		return false;
	}else{
		return true;
	}
}

function ValidateThisField(field_id){
	var this_field = $('#'+field_id);
    
    if(!this_field.val()){
		this_field.css({'border-color': 'rgb(236 118 118)'});
	}
	else{
		this_field.css('border-color','');
    	this_field.css('box-shadow','none');
	}
}
