$(function(){
	

	if($(".tblList").length)
		$(".tblList").tablesorter();
	
	var temp_w=$('.message').width()+24;
	var margin=($(window).width()-temp_w)/2;
	$('.message').css({'left':margin}).animate({'top':'60px'},1000).fadeIn(400).delay(2000).animate({'top':'-120px'},1000).fadeOut(400);

	var per_str	=	$('#permission_str').val();
	if(per_str != '*'){
		user_per_arr	=	per_str.split(',');
		
		
		$('.permission').each(function(){
			permission	=	$(this).attr('data');
			if(!in_array(permission, user_per_arr))
				$(this).hide();
		})
	}
	
	$('.remove-image-show').click(function(){
		$('#img_flag_name').val('');
		$('#show_upload').attr('src', '#');
		$('.image-box').fadeOut(400);
	})
	
	/*$('.search-box').keypress(function(e){
		if(e.keyCode == 13){
			$('#frm-search').submit();
		}
		
	})
	
	$('.search-combo').change(function(){
		$('#frm-search').submit();
	})*/
	
	$('.search-button').click(function(){
		$('#frm-search').submit();
	})
})

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader 	=	new FileReader();
		file_name	=	input.files[0].name;
		reader.onload = function (e) {
			$('#show_upload').attr('src', e.target.result);
			$('#img_flag_name').val(file_name);
			$('.image-box').fadeIn(400);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

function in_array (needle, haystack, argStrict) {
	// http://kevin.vanzonneveld.net
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: vlado houba
	// +   input by: Billy
	// +   bugfixed by: Brett Zamir (http://brett-zamir.me)
	// *     example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
	// *     returns 1: true
	// *     example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
	// *     returns 2: false
	// *     example 3: in_array(1, ['1', '2', '3']);
	// *     returns 3: true
	// *     example 3: in_array(1, ['1', '2', '3'], false);
	// *     returns 3: true
	// *     example 4: in_array(1, ['1', '2', '3'], true);
	// *     returns 4: false
	var key = '',
	strict = !! argStrict;

	if (strict) {
		for (key in haystack) {
			if (haystack[key] === needle) {
				return true;
			}
		}
	} else {
		for (key in haystack) {
			if (haystack[key] == needle) {
				return true;
			}
		}
	}
	return false;
}

function substr_replace (str, replace, start, length) {
	// http://kevin.vanzonneveld.net
	// +   original by: Brett Zamir (http://brett-zamir.me)
	// *     example 1: substr_replace('ABCDEFGH:/MNRPQR/', 'bob', 0);
	// *     returns 1: 'bob'
	// *     example 2: $var = 'ABCDEFGH:/MNRPQR/';
	// *     example 2: substr_replace($var, 'bob', 0, $var.length);
	// *     returns 2: 'bob'
	// *     example 3: substr_replace('ABCDEFGH:/MNRPQR/', 'bob', 0, 0);
	// *     returns 3: 'bobABCDEFGH:/MNRPQR/'
	// *     example 4: substr_replace('ABCDEFGH:/MNRPQR/', 'bob', 10, -1);
	// *     returns 4: 'ABCDEFGH:/bob/'
	// *     example 5: substr_replace('ABCDEFGH:/MNRPQR/', 'bob', -7, -1);
	// *     returns 5: 'ABCDEFGH:/bob/'
	// *     example 6: 'substr_replace('ABCDEFGH:/MNRPQR/', '', 10, -1)'
	// *     returns 6: 'ABCDEFGH://'
	if (start < 0) { // start position in str
		start = start + str.length;
	}
		length = length !== undefined ? length : str.length;
	if (length < 0) {
		length = length + str.length - start;
	}
	return str.slice(0, start) + replace.substr(0, length) + replace.slice(length) + str.slice(start + length);
}

function printObject(o) {
	var out = '';
	for (var p in o) {
		out += p + ': ' + o[p] + '\n';
	}
	alert(out);
}