jQuery(function(){
	$('#frm-edit-notif').validationEngine({});
	
	$( "#start_push" ).datetimepicker({
			defaultDate: new Date() ,
			showSecond: true,
			timeFormat: 'HH:mm:ss',
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear:true,
			yearRange: "2013:2015",
		});

});
