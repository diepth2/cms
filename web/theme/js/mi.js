
function showTopCaoThu(){
    $("#tabCaoThu").removeClass("hidden");
    $("#tabVip").addClass("hidden");
    $("#tabDaiGia").addClass("hidden");
}
function showTopDaiGia(){
    $("#tabCaoThu").addClass("hidden");
    $("#tabVip").addClass("hidden");
    $("#tabDaiGia").removeClass("hidden");
}
function showTopVip(){
    $("#tabCaoThu").addClass("hidden");
    $("#tabVip").removeClass("hidden");
    $("#tabDaiGia").addClass("hidden");
}
function showTab(_id){
    for(i=1;i<4;i++){
        $("#tab"+i).removeClass('tabl1').addClass('tabl-inactive1');
        $("#tab"+i+" a").removeClass('tabr-active1').addClass('tabr-inactive1');
        $("#tab"+_id).removeClass('tabl-inactive1').addClass('tabl1');
        $("#tab"+_id+" a").removeClass('tabr-inactive1').addClass('tabr-active1');
        $("#content_"+i).hide();
        $("#content_"+_id).show();
    }
    }
function showTabGameIntro(){
    $("#tab_intro").removeClass("tabl-inactive").addClass("tabl").addClass("overflow");
    $("#tab_intro a").removeClass("tabr-inactive").addClass("tabr-active");
    $("#tab_guide").removeClass("tabl").removeClass("overflow").addClass("tabl-inactive");
    $("#tab_guide a").removeClass("tabr-active").addClass("tabr-inactive")
    $("#tab_guide_content").hide();
    $("#tab_intro_content").show();
}
function showTabGameGuide(){
    $("#tab_guide").removeClass("tabl-inactive").addClass("tabl").addClass("overflow");
    $("#tab_guide a").removeClass("tabr-inactive").addClass("tabr-active");
    $("#tab_intro").removeClass("tabl").removeClass("overflow").addClass("tabl-inactive");
    $("#tab_intro a").removeClass("tabr-active").addClass("tabr-inactive")
    $("#tab_intro_content").hide();
    $("#tab_guide_content").show();
}
function sumbutFormLogin(){
    $("form[name='login']").submit();
}
function isValidEmail(str){
    return(str.indexOf(".")>2)&&(str.indexOf("@")>0);
}
$(function(){
    $("form[name='login']").submit(function(){
        var _username=$("#username").val();
        var _pass=$("#pass").val();
        if(_username==''||_username=='Username'){
            alert("Bạn chưa điền tên đăng nhập");
            return false;
        }
        if(_pass==''||_pass=='Password'){
            alert("Bạn chưa điền mật khẩu");
            return false;
        }
        $.ajax({
            url:base_url+"user/login",
            type:"POST",
            data:{
                username:_username,
                pass:_pass
            },
            beforeSend:function(xhr){
                $("#button_login").attr('src',base_url+'public/temp/images/ajax-loader.gif');
            },
            timeout:10000,
            error:function(xhr,status){
                switch(status){
                    case"timeout":
                        $("#button_login").attr('src',base_url+'public/temp/images/ajax-loader.gif');
                        break;
                    default:
                        $("#button_login").attr('src',base_url+'public/temp/images/ajax-loader.gif');
                        break;
                }
            },
        success:function(response,status){
            $("#button_login").attr('src',base_url+'public/temp/images/button/login.png');
            switch(response){
                case"NOT_ACTIVATE":
                    $("#txt_dangnhap").remove();
                    alert("Tài khoản của bạn chưa kích hoạt, vui hãy kiểm tra email để kích hoạt tài khoản");
                    break;
                case"USER_BANNED":
                    alert("Tài khoản của bạn đã bị khoá!");
                    break;
                case"SUCSESS":
                    history.go(0);
                    break;
                case"UNSUCSESS":default:
                    $("#txt_dangnhap").remove();
                    alert("Tên đăng nhập hoặc mật khẩu không đúng!");
                    break;
            }
        }
        });
return false;
});
})
function submitPostMarket(){
    $("form[name='post_market']").submit();
}
function resetPostMarket(){
    $('#post_market *').val("");
}
$(function(){
    $("form[name='post_market']").submit(function(){
        var _title=$("#title").val();
        var _content=$("#content").val();
        var _ciao=$("#ciao").val();
        if(_title==''){
            alert('Xin mời điền tiêu đề');
            return false;
        }
        else if(_content==''){
            alert('Xin mời điền nội dung');
            return false;
        }
        else if(_ciao==''){
            alert('Xin mời điền số ciao');
            return false;
        }
        $.ajax({
            url:base_url+"market/insert",
            type:"POST",
            data:{
                title:_title,
                content:_content,
                ciao:_ciao,
                exchange_status:$("#exchange_status").val()
                },
            beforeSend:function(xhr){},
            timeout:10000,
            error:function(xhr,status){
                switch(status){
                    case"timeout":
                        $("#img-waiting-status").hide();
                        break;
                    default:
                        $("#img-waiting-status").hide();
                        break;
                }
            },
        success:function(response,status){
            $("#img-waiting-status").hide();
            switch(response){
                case"NOT_ENOUGH":
                    alert('Số ciao hiện tại của bạn < '+_ciao);
                    break;
                case"SUCSESS":
                    alert('Bạn đã bị trừ 100 Ciao phí dao dịch');
                    window.location=base_url+"market";
                    break;
                case"UNSUCSESS":default:
                    alert("Có lỗi trong quá trình thao tác, vui lòng thử lại sau!");
                    break;
            }
        }
        });
return false;
});
})
$(function(){
    $('.top_glist').hover(function(){
        $("#top_qglist").stop(true,true).slideDown().show('slow');
    },function(){
        $("#top_qglist").stop(true,true).slideUp().hide('slow');
    });
    $("#top_qglist").hover(function(){
        $('.top_glist').addClass('topbar2_game2');
        $(this).stop(true,true).show();
    },function(){
        $('.top_glist').removeClass('topbar2_game2');
        $(this).stop(true,true).hide();
    });

    $("#type_send").click(function(){
        $("#formtypesend").show(200);
        $("#forminport").hide(200);
    });
    $("#inportsend").click(function(){
        $("#formtypesend").hide(200);
        $("#forminport").show(200);
    });
})
function playGame(url,sL,nS){
    var height=699;
    var width=1020;
    var top=(screen.height-height)/2;
    var left=(screen.width-width)/2;
    playWin = window.open(url,'_blank','toolbar=no,menubar=no,scrollbars=yes,resizable=no,location=no,directories=no,status=no'
        +'fullscreen=no,titlebar=no, height='+height
        +',width='+width+','
        +'top='+top+','+'left='+left);
};

function search(id_textbox){
    _keyword=$("#"+id_textbox).val();
    if(_keyword=='Tìm kiếm...')
        return true;
    var _keyword_decode=urlrewrite_encode(trim(_keyword));
    var url_search=base_url+'search/home/'+_keyword_decode;
    if(_keyword_decode!=null&&_keyword_decode!='')
        window.location.href=url_search;
    return true;
}
function urlrewrite_encode(text){
    var ret="";
    text=text.split("");
    for(var i=0;i<text.length;i++){
        if(isalnum(text[i])){
            ret+=text[i];
        }else if(text[i]==' '){
            ret+="+";
        }else if(text[i]=='+'){
            ret+="%2B";
        }else{
            ret+='\\'+text[i].charCodeAt(0);
        }
    }
return ret;
}
function isalnum(ch){
    var reEncode=new RegExp('[a-zA-Z0-9Ã Ã¡áº£áº¡Ã£Äáº¯áº±áº³áºµáº·Ã¢áº¥áº§áº©áº«áº­ÄÃ©Ã¨áº»áº½áº¹Ãªáº¿á»á»á»á»Ã­Ã¬á»Ä©á»Ã³Ã²á»Ãµá»Ã´á»á»á»á»á»Æ¡á»á»á»á»¡á»£ÃºÃ¹á»§Å©á»¥Æ°á»©á»«á»­á»¯á»±Ã½á»³á»·á»¹á»µÃÃáº¢áº ÃÄáº®áº°áº²áº´áº¶Ãáº¤áº¦áº¨áºªáº¬ÄÃÃáººáº¼áº¸Ãáº¾á»á»á»á»ÃÃá»Ä¨á»ÃÃá»Ãá»Ãá»á»á»á»á»Æ á»á»á»á» á»¢ÃÃá»¦Å¨á»¤Æ¯á»¨á»ªá»¬á»®á»°Ãá»²á»¶á»¸á»´,-.!~`@$^&)(_=;}{]');
    return reEncode.test(ch);
}
function trim(str,chars){
    return ltrim(rtrim(str,chars),chars);
}
function ltrim(str,chars){
    chars=chars||"\\s";
    return str.replace(new RegExp("^["+chars+"]+","g"),"");
}
function rtrim(str,chars){
    chars=chars||"\\s";
    return str.replace(new RegExp("["+chars+"]+$","g"),"");
}
function showAlertBox (message, title, container, timeout) {
    var alertBox = $('<div class="alert_box" style="position: absolute; z-index: 10;"><div class="top"><div class="border_line"></div></div><div class="content"><div class="title"></div><div class="text"></div><div class="close"></div></div><div class="bottom"><div class="border_line"></div></div></div>');
	
    $(".content .title", alertBox).html(title);
    $(".content .text", alertBox).html(message);
	
    if (!container) {
        container = '#main';
    }
		
    displayBox(alertBox, container, typeof(timeout) != 'undefined' ? timeout : 1500);
}

var sendGiftBox = '';
var GiftPrizeBox = '';
function showGiftPrizeBox(ciao) {
    GiftPrizeBox = $('<div class="gift_prize_box"><div class="prize"></div><div class="close"></div>' + (pid == 2 && ciao >= 10000 ? '<div onClick="postGiftToFacebookWall('+ciao+');" class="feedfb"></div>' : '') + '</div>');
    $(".prize", GiftPrizeBox).html(ciao);
	
    if ($('#gift_count').html() > 0) {
        $('#gift_count').html(parseInt($('#gift_count').html()) - 1);
    } else if ($('#friend_gift_count').html() > 0) {
        $('#friend_gift_count').html(parseInt($('#friend_gift_count').html()) - 1);
    }
	
    _gaq.push(['_trackEvent', 'Daily Bonus', 'openGift', giftDay, ciao]);
    displayBox(GiftPrizeBox, '#giftcontent', 0, function() {
        updateGiftFlash();
    });
}

function loadGiftBoxSWF(url) {
    var flashvars = {
    };
	
    var params = {
        menu: "false",
        scale: "noScale",
        allowFullscreen: "true",
        allowScriptAccess: "always",
        wmode: "transparent"
    };
    var attributes = {
        id:"giftFlash"
    };
	
    swfobject.embedSWF(url, "giftFlash", "100%", "230", "10.0.0", "expressInstall.swf", flashvars, params, attributes);
}

function reloadGiftBoxSWF(url) {
    swfobject.removeSWF(giftFlash);
    loadGiftBoxSWF(url);
}

function updateGiftFlash() {
    var giftFlash = swfobject.getObjectById("giftFlash");
    if (giftFlash != null) {
        giftFlash.updateSpecialGift();
    }
}

function removeBox(box, container, timeout, closeCallback, loadCallback) {
    console.log('asdfasdfasdf');			
//box.remove();
}

var boxCount = new Array();
function displayBox(boxE, container, timeout, closeCallback, loadCallback) {
    //removeBox(box, container, timeout, closeCallback, loadCallback);
    //if (!container) {
    container = '#main';
    //}
	
    if (typeof(boxCount[container]) == 'undefined') {
        boxCount[container] = 0;
    }

    if (boxCount[container] == 0) {
        $(container).prepend('<div id="box_overlay" style="position: absolute; z-index: 1;" class="alpha70"></div>');
        $("#box_overlay", container).height($(container).height());
        $("#box_overlay", container).width($(container).width());
    }
    //console.log(box.attr('id'));
    var box = boxE;

    if(boxE.attr('id').length > 0 && $('#'+boxE.attr('id'), container).length > 0) {
        $('#'+boxE.attr('id'), container).remove();
        boxCount[container]--;
    }
	
    if(boxE.attr('class').length > 0 && $('.'+boxE.attr('class'), container).length > 0) {
        $('.'+boxE.attr('class'), container).remove();
        boxCount[container]--;
    }
    $(container).append(box);
    boxCount[container]++;
    box.css('position', 'absolute');
    box.css('z-index', 2);
    box.css("left", ($(document).width() - box.width())/2);
    box.css("margin-top", ($(container).height() - box.height())/2);
    box.show();
	
    if (loadCallback) {
        loadCallback();
    }
	
    $(".close", box).bind({
        click: function() {
            if(closeCallback) {
                closeCallback();
            }
			
            boxCount[container]--;
			
            box.remove();
			
            if (timeoutHandle) {
                clearTimeout(timeoutHandle);
            }
			
            if (boxCount[container] <= 0) {
                $("#box_overlay", container).remove();
            }
        }
    });
	
    if (timeout > 0) {
        //auto close
        var timeoutHandle = window.setTimeout(function() {
            if(closeCallback) {
                closeCallback();
            }
			
            boxCount[container]--;
			
            box.remove();
			
            if (boxCount[container] <= 0) {
                $("#box_overlay", container).remove();
            }
        }, timeout);
    }

}

var ScriptSoup ={
    _scriptFragment: '<script[^(>|fbml)]*>([\\S\\s]*?)<\/script>',
    set: function(el, html) {
        el.innerHTML = ScriptSoup.stripScripts(html);
        ScriptSoup.evalScripts(html);
    },
    stripScripts: function(html) {
        return html.replace(new RegExp(ScriptSoup._scriptFragment, 'img'), '');
    },
    evalScripts: function(html) {
        var
        parts = html.match(new RegExp(ScriptSoup._scriptFragment, 'img')) || [],
        matchOne = new RegExp(ScriptSoup._scriptFragment, 'im');
        for (var i=0, l=parts.length; i<l; i++) {
            try {
                eval((parts[i].match(matchOne) || ['', ''])[1]);
            } catch(e) {
            }
        }
    }
};

$(function(){    
    $('#username_hover').hover(function(){	       
        $("#wrap_scroll_user").stop(true,true).slideDown().show('slow');
    },function(){	      
        $("#wrap_scroll_user").stop(true,true).slideUp().hide('slow');		  
    });
    
    $("#wrap_scroll_user").hover(function(){        
        $(this).stop(true,true).show();
    },function(){        
        $(this).stop(true,true).hide();
    });

})

var notifications = new Array();
var noti_container = '';
var current_index = 0;

function check_notification(gid) {
    get_notification(gid);
    $.doTimeout( 'check_notification',  1000*30, function(){
        return get_notification(gid);
    });
}

function get_notification(gid) {
    $.ajax({
        url: base_url + 'game/getAjaxNotifications/' + gid + '?t=' + (new Date()).getTime(),
        type: "POST",
        dataType: "json",
        success: function(data) {
            var now = Math.round((new Date()).getTime() / 1000);
            if (data != 'false') {
                var i = 0;
                $.each(data, function(index, value) {
                    if (now > value.start_time && now <= value.end_time) {
                        notifications[i] = value;
                        i++;
                    }		   			
                });
		   		
                display_notification();
            }
        }
    });

    return true;
}

function draw_notification(){
    if (notifications.length > 0) {
        display_notification();
    }
}

function display_notification() {
    if (notifications.length == 0) {
        return false;
    }
	
    noti_container = '';
	
    $("#notification").html('');

    noti_container = $('<div style="display: table; width: 100%; line-height: 16px; margin: 5px 0 5px 0; background: #000;"><div id="noti_content"><div class="noti_title">Thông báo:</div><div id="noti_close">x</div><div id="noti_slider"></div></div></div>');
	
    $("#noti_close", noti_container).click(function () {
		
        noti_container = '';
        // cancel loop
        $.doTimeout('check_notification');
        if (window.FB) {
            FB.Canvas.setAutoResize();
            $("#notification").html('');
        } else {
            $("#notification").html('');
            window.setTimeout(publishHeight, 500);
        }
    });
	
    var notifications_html = '';
    $.each(notifications, function (index, value) {
        notifications_html = notifications_html + '<div>' + value.content + '</div>';
    });
	
    $("#noti_slider", noti_container).html(notifications_html);
    $("#notification").html(noti_container);
    $("#noti_slider", $("#notification")).bxSlider({
        controls: false,
        speed: 500,
        pause: 10000,
        auto: true
    });
	
    if (window.FB) {
        FB.Canvas.setAutoResize();
    } else {
        window.setTimeout(publishHeight, 500);
    }
	
    return false;
}
function lazyLoadImages(){
    $("img.lazy").lazyload({
        failure_limit	: 10,
        effect          : "fadeIn"
    });
}

/** Khi hover vảo ảnh Deal **/
function hoverImgDeal(){
    $(".deal_detail").hover(function(){
       // $(this).find(".number_buy").fadeIn(200);
        $(this).find(".quick").show();
       // $(this).find(".info_right").show();
       // $(this).find(".pha_information_list").slideDown(200);
    },function(){
       // $(this).find(".number_buy").fadeOut(200);
        $(this).find(".quick").hide();
        //$(this).find(".info_right").hide();
        //$(this).find(".pha_information_list").fadeOut();
    });

/**
	// Show hide các tip like - xem nhanh
	$(".quickLike").hover(function(){
		$(this).next().slideDown('fast');
	},function(){
		$('.tip_quickLike').hide();
	});

	$('.quickView').hover(function(){
		$(this).next().slideDown('fast');
	},function(){
		$('.tip_quickView').hide();
	});
	*/
}


