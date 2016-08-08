(function($)
{
  $(document).ready(function() {
	  
	  if ($('#slideshow-list').size())
	  {
		  $('#slideshow-list').anythingSlider({
		  		buildArrows: false,
		  		width:725,
		  		height:253,
		  		delay: 8000, 
		  		resumeDelay: 8000,
		  		autoPlayLocked: true,
		  		infiniteSlides: false,
		  		startStopped: false,
		  		navigationFormatter : function(i, panel){
		  			return '';
		  		}
		  	});
	  }
	  
	  
  });
  
})(jQuery);
