jQuery(function(){
	$('#frm-edit-news').validationEngine({});
	
	$('.remove-image-upload').live('click',function(){
		var em_id		=	$(this).attr('id');
		base_url		=	$('#ajax_url').val();
		
		$('.overlay').fadeIn(400);
		jQuery.ajax({
			url: base_url+'/admin/emoticon/ajaxDeleteImg/'+em_id,
			type: 'POST',
			cache: false,
			dataType:'json',
			data: 'em_id='+em_id,
			success: function(result){		
				if(result.success){
					$('#img_flag_name').val('');
					$('#show_upload').attr('src', '#');
					$('.image-box').fadeOut(400);
				}else
					alert('Xảy ra lỗi trong quá trình xóa ảnh!');
					
				$('.overlay').fadeOut(400);
			},
			error: function (data){
				$('.overlay').fadeOut(400);
				alert(data.error);
				alert('Có lỗi xảy ra');
			}
		});
		
	})
	
});
