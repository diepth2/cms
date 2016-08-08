jQuery(function(){
	//var temp_w=$('.message').width()+24;
	//var margin=($(window).width()-temp_w)/2;
	//$('.message').css({'left':margin}).animate({'top':'60px'},1000).fadeIn(400).delay(2000).animate({'top':'-120px'},1000).fadeOut(400);

	$('#frm-role').validationEngine({});
	$('#frm-edit-role').validationEngine({});
	
	$('#add-role').click(function(){
		$('#frm-role').slideToggle(400);
	});
	
	
	$('.chk-parent').live('change', function(){
        var $this = $(this);
        var d = $this.attr('id');
		
        if($this.is(':checked')){
            $('.chk-'+d).attr('checked', 'checked');
        }else{
            $('.chk-'+d).removeAttr('checked');
        }
    });
    $('.action input[type="checkbox"]').live('change', function(){
    	var this_class = $(this).attr('data');
		
    	var i_id = this_class.replace('chk-', '');
    	var total = $('.'+this_class).length;
    	var total_check = $('.'+this_class+':checked').length;
    	if(total_check == 0){
    		$('#'+i_id).removeAttr('checked');
    	}else if(total_check == total){
    		$('#'+i_id).attr('checked', 'checked');
    	}
    });
    $('.area').live('change', function(){
    	var sl = $(this).val();
    	if(sl == 'all'){
    		$('.dsa').slideUp(400);
    	}else{
    		$('.dsa').slideDown(400);
    	}
    });
	
	$('.submit-edit-permission').click(function(){
		var role_type	=	$('#role_type').val();
		if(role_type == 'custome'){
			var total_check	=	$('.permission-check:checked').length;
			if(total_check == 0){
				alert('Hãy chọn ít nhật 1 quyền!');
				return false;
			}
			
		}
		$('#frm-edit-role').submit();
	})
	
});
