$(function(){
	var buttons	=	{ 
						previous:$('#jslidernews3 .button-previous') ,
						next:$('#jslidernews3 .button-next') 
					};

	$('#jslidernews3').lofJSidernews( { 
		interval 		:	4000,
		direction		:	'opacity',	
		easing			:	'easeOutBounce',
		duration		:	1200,
		auto		 	:	true,
		mainWidth		:	980,
		buttons			:	buttons,
	});
	
	
	$('.popup-contain').bPopup({
		speed: 650,
		transition: 'slideIn'
	});
});