$(function(){
	$('#frm-register').validationEngine({});
	$( ".birth-date" ).datepicker({
		defaultDate: "+1w",
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear:true,
		yearRange: "1900:2013",
	});
});