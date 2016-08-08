jQuery(function(){
	var temp_w=$('.message').width()+24;
	var margin=($(window).width()-temp_w)/2;
	$('.message').css({'left':margin}).animate({'top':'60px'},1000).fadeIn(400).delay(2000).animate({'top':'-120px'},1000).fadeOut(400);

	// Checking for CSS 3D transformation support
	jQuery.support.css3d = supportsCSS3D();
	var formContainer = jQuery('#formContainer');
	
        
	// Listening for clicks on the ribbon links
	jQuery('.flipLink').click(function(e){
		
		// Flipping the forms
		formContainer.toggleClass('flipped');
		
		// If there is no CSS3 3D support, simply
		// hide the login form (exposing the recover one)
		if(!jQuery.support.css3d){
			jQuery('#login').toggle();
		}
		e.preventDefault();
	});

	
	
	// A helper function that checks for the 
	// support of the 3D CSS3 transformations.
	function supportsCSS3D() {
		var props = [
			'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
		], testDom = document.createElement('a');
		  
		for(var i=0; i<props.length; i++){
			if(props[i] in testDom.style){
				return true;
			}
		}
		
		return false;
	}
});
