$(function(){
	$('#frm-register').validationEngine({});
	$('#frm-edit').validationEngine({});
	/*phan cmn trang*/
	var total_item = $('.member-item li').size();
	var item_show = 15;
	var total_page = Math.ceil(total_item / item_show);
	var start = 0;
	var page = 1;
	$('.member-item li').each(function(e){
		if(start == item_show){
			start=0;
			page++;
		}
		$(this).addClass('item'+page);
		if((e+1) > item_show){
			$(this).hide();
		}
		start++;
	});
	var html_page = '<div class="small-pagin">';
	for(var i=1; i<=total_page; i++){
		html_page += '<a href="#page-'+i+'" class="page_item'+(i==1 ? ' pactive' : '')+'">'+i+'</a>';
	}
	html_page += '</div>';
	$('.member-item').after(html_page);
	$(document).on('click', '.page_item', function(){
		var this_page = $(this).html();
		$('.member-item li:visible').hide();
		$('.page_item').removeClass('pactive');
		$(this).addClass('pactive');
		$('.item'+this_page).show();
	});
	var hash = window.location.hash.substring(1);
	$('.page_item[href="#'+hash+'"]').trigger('click');
	
	
	var total_item = $('.list-avatar li').size();
	var item_show = 24;
	var total_page = Math.ceil(total_item / item_show);
	var start = 0;
	var page = 1;
	$('.list-avatar li').each(function(e){
		if(start == item_show){
			start=0;
			page++;
		}
		$(this).addClass('item'+page);
		if((e+1) > item_show){
			$(this).hide();
		}
		start++;
	});
	var html_page = '<div class="small-pagin">';
	for(var i=1; i<=total_page; i++){
		html_page += '<a href="#page-'+i+'" class="page_item'+(i==1 ? ' pactive' : '')+'">'+i+'</a>';
	}
	html_page += '</div>';
	$('.list-avatar').after(html_page);
	$(document).on('click', '.page_item', function(){
		var this_page = $(this).html();
		$('.list-avatar li:visible').hide();
		$('.page_item').removeClass('pactive');
		$(this).addClass('pactive');
		$('.item'+this_page).show();
	});
	var hash = window.location.hash.substring(1);
	$('.page_item[href="#'+hash+'"]').trigger('click');
	
	$('.ui-tabs a').click(function(){
		var this_select = $(this).attr('href').replace('#', '');
		$('.ui-tabs a:visible').removeClass('active-tab');
		$(this).addClass('active-tab');
		$('.tab-panel').addClass('hidden');
		$('#'+this_select).removeClass('hidden');
		return false;
	});
	
	$('#join_clan').click(function(){
		$('#frm-register').submit();
	})
	
	
	$('.brn .cancel').click(function(){
		var user_id	=	$(this).attr('data');
		answer		=	confirm('Bạn chắc chứ?');
		if(answer){
			$('#action-'+user_id).val('cancel');
			$('#frm-register-'+user_id).submit();
		}
	})
	
	$('.kick-box .kick').click(function(){
		var user_id	=	$(this).attr('id');
		answer		=	confirm('Bạn chắc chứ?');
		if(answer){
			$('#frm-kick-'+user_id).submit();
		}
	})
	
	$('.brn .agree').click(function(){
		var user_id	=	$(this).attr('data');
		answer		=	confirm('Bạn chắc chứ?');
		if(answer){
			$('#action-'+user_id).val('agree');
			$('#frm-register-'+user_id).submit();
		}
	})
});