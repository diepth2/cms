$(function(){
	$.ajaxSetup({ cache: true });
	$.getScript('//connect.facebook.net/en_UK/all.js', function(){
		FB.init({			
			appId: '645005412239595',
			status     : true,
			xfbml      : true
		});     
		$('.login-facebook').click(function(){
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					FB.api('/me', function(response) {
						setRequest(response)
					})
				}else {
					FB.login(function(response) {
						if (response.authResponse) {
							FB.api('/me', function(response) {
								setRequest(response)
							});	   
						}		
					}, {scope: 'email,user_likes'})
				}
			});
		
		})
	});
	
	
	function setRequest(response){
		var username	=	response['username'];
		var name		=	response['name'];
		var email		=	response['email'];
		var gender		=	response['gender'];
		var fb_id		=	response['id'];
		var birth		=	response['birthday'];
		
		$('#username').val(username);
		$('#email').val(email);
		$('#sex').val(gender);
		$('#facebookid').val(fb_id);
		$('#fullname').val(name);
		$('#birth').val(birth);
		//alert(name);
		$('#frm-login-fb').submit();
	}

	$('.haschild').hover(function(){
		$('.child').stop().slideDown(200);
	}, function(){
		$('.child').stop().slideUp(200);
	});
	
	$('.slideshow').cycle();
	
	$('.head-tab').on('click', 'a', function(){
		var current = $(this).attr('data');
		if(current){
			$('.head-tab a').removeClass('active');
			$(this).addClass('active');
			$('.list-tab').addClass('hidden');
			$('#c-'+current).removeClass('hidden');
			return false;
		}
	});
	
	
	$('.content-tab').on('click', '.c-tabs', function(){
		var current = $(this).attr('data');
		if(current){
			$('.content-tab a').removeClass('active');
			$(this).addClass('active');
			$('.c-content').addClass('hidden');
			$('#c-'+current).removeClass('hidden');
			return false;
		}
	});
	
	
	$('#btn-submit-login').click(function(){
		return $('#frm-login').validationEngine({
			promptPosition : "bottomRight"
		});
		
		//$('#frm-login').submit();
	})
	
	$('.required').click(function(){
		var login_url	=	$('#login_url').val();
		x				=	confirm("Để được chơi nhưng game online bạn cần phải đăng nhập trước\n thực hiện đăng nhâp?");
		if(x) window.location.href	=	login_url;
		else return false
	})
	
	$('#convert-cash').click(function(){
		$('#migame-form-sso-convert-cash').submit();
	})
	
	/*==================================pagging===================================*/
	var total_item = $('.list-new li').size();
	var item_show = 4;
	var total_page = Math.ceil(total_item / item_show);
	var start = 0;
	var page = 1;
	$('.list-new li').each(function(e){
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
	var html_page = '<div class="small-pagin" style="display:inline-block;width:100%;">';
	for(var i=1; i<=total_page; i++){
		html_page += '<a href="#page-'+i+'" class="page_item'+(i==1 ? ' pactive' : '')+'">'+i+'</a>';
	}
	html_page += '</div>';
	$('.list-new').after(html_page);
	$(document).on('click', '.page_item', function(){
		var this_page = $(this).html();
		$('.list-new li:visible').hide();
		$('.page_item').removeClass('pactive');
		$(this).addClass('pactive');
		$('.item'+this_page).show();
	});
	var hash = window.location.hash.substring(1);
	$('.page_item[href="#'+hash+'"]').trigger('click');
	/*==================================End pagging===============================*/
	
	function printObject(o) {
		var out = '';
		for (var p in o) {
			out += p + ': ' + o[p] + '\n';
		}
		alert(out);
	}

});
