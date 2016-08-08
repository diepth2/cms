/**
 * Created by vtsoft on 4/29/14.
 */

$(document).ready(function () {

    $('#slider-1 ul').anythingSlider(
        {
            buildArrows:false,
            // width: 670,
            // height: 300,
            delay:3000,
            resumeDelay:3000,
            autoPlayLocked:true,
            infiniteSlides:false,
            startStopped:false,
            navigationFormatter:function (i, panel) {
                return '';
            },
            hashTags:false,
            expand:true,
            autoPlay:true
        });

    $('#site-services > ul').ContentSlider('#site-services .button-next', '#site-services .button-back', 3);
    $('#product-img-slide ul.group-3').ContentSlider('#product-img-slide .button-next', '#product-img-slide .button-back', 3);
});


$(document).ready(function () {
    $('#service-choice').chosen({ 'disable_search':true, width:'432px' });

    isoftzModal.create('#login-popup', 635, false);
    isoftzModal.create('#register-popup', 635, false);

    $('#login-viettel').click(function () {
        isoftzModal.show('#login-popup');

        return false;
    });

    $('#register-viettel').click(function () {
        isoftzModal.show('#register-popup');

        return false;
    });

    $('#login-popup .close-popup').click(function () {
        isoftzModal.closePopUp('#login-popup');

        return false;
    });

    $('#login-popup button[type="submit"]').click(function () {
        var username = jQuery('#login-username').val();
        var password = jQuery('#login-password').val();
        if (username == "admin" && password == "admin") {
            $('#login-password').closest('p').removeClass('has-error');
            window.location.reload(true);
        } else {
            jQuery('#login-password').closest('p').addClass('has-error');
        }

        return false;
    });

    $('#register-popup .close-popup').click(function () {
        isoftzModal.closePopUp('#register-popup');

        return false;
    });

    $('#register-popup button[type="submit"]').click(function () {

        return false;
    });


});
function doClick(e, button) {
    var key;
    if (window.event)
        key = window.event.keyCode;     //IE
    else
        key = e.which;     //firefox
    if (key == 13) {
        var btn = $("#" + button);
        if (btn != null) {
            btn.click();
        }
    }
}

function registerEmail() {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = $('#email').val();
    var link_send = $('#link_send').val();
    var invalid = $('#invalid-email').val();
    if (re.test(email)) {
        $.post(link_send, {email:email, token:$("#token-email").val()}, function (result) {
            obj = $.parseJSON(result);
            alert(obj['notice']);
        });
    }
    else {
        alert(invalid);
    }
}
//chon tinh thanh pho
function changeCity(url, urlTransactionSelect) {
//    var select = this.options[this.selectedIndex].value;
    var select = $('#city-select').val();
    if (select > 0) {
        $.post(url, {selectCity:select, token:$("#ajax_token").val()}, function (result) {
            var arrAction = new Array();
            arrAction = $.parseJSON(result);
            $("#city-select-parent Option").each(function () {
                $(this).remove();
            });
            $.each(arrAction, function (key, value) {
                key = key.substring(1, key.length);
                $('#city-select-parent').append($('<option>', {
                    value:'' + key + '',
                    text:value
                }));
            });
        });
    }
    else {
        $("#city-select-parent Option").remove();
        $('#city-select-parent').append($('<option>', {
            value:'' + '-1' + '',
            text:'---Quận/Huyện/Thị xã---'
        }));
    }
    OpenMap(select, urlTransactionSelect);
}

// Chọn quận huyện
function changeProvince(urlTransactionSelect) {
    var select = $('#city-select-parent').val();
    if (select > 0) {
        OpenMap(select, urlTransactionSelect);
    } else {
        OpenMap($("#city-select").val(), urlTransactionSelect);
    }
}

OpenMap = function (provinceID, urlTransactionSelect) {
    $.post(urlTransactionSelect, {provinceID:provinceID, token:$("#ajax_token").val()}, function (result) {
        var locations = new Array();
        arrCity = $.parseJSON(result);
        for (var i = 0; i < arrCity.length; i++) {
            locations.push(arrCity[i]);
        }
        CreateMap(locations);
    })
}

// Bỏ thích ý tưởng
function unlikeIdea(url, idea_id, user_id, total_like) {
    $.ajax({
        type:"GET",
        url:url,
        data:{ideaId:idea_id, userId:user_id, totalLike:total_like},
        cache:true,
        success:function (data) {
            obj = $.parseJSON(data);
            location.reload();
        },
        error:function (request, status, err) {
        }
    });
}

// Thích ý tưởng
function likeIdea(url, idea_id, user_id, total_like) {
    $.ajax({
        type:"GET",
        url:url,
        data:{ideaId:idea_id, userId:user_id, totalLike:total_like},
        cache:true,
        success:function (data) {
            obj = $.parseJSON(data);
            location.reload();
        },
        error:function (request, status, err) {
        }
    });
}
//Search ý tưởng
function searchIdea() {
    var txtSearch = $("#idea-group-keyword").val();
    var txtDate = $("#txt-date").val();
    var keyword = '';
    if (txtSearch != '' && txtDate != '') {
        keyword = 'qi=' + txtSearch + '|date=' + txtDate;
    } else if (txtSearch != '') {
        keyword = 'qi=' + txtSearch;
    } else if (txtDate != '') {
        keyword = 'date=' + txtDate;
    }

    redUrl = window.location.href;
    keyword = Base64.encode(keyword);
    keyword = keyword.replace('/', '|');

    redUrl = searchLink.replace('searchKeyword', keyword);
    alert(redUrl);
//    window.open(redUrl,'_self');
    window.location.href = redUrl;
}
//
//function checkValueDate(url){
//    var txtDate = $("#vtp_ideas_updated_at_date").val();
//    var txtTitle = $("#idea-group-keyword").val();
//    if (txtDate!='' && txtTitle!='') {
//        url= url + '/' + txtDate+'/'+txtTitle;
//    }     
//    window.open(url,'_self');
//
//}



// huync2: chon thanh pho
//chon tinh thanh pho
function changeCityWap(url, urlTransactionSelect) {
//    var select = this.options[this.selectedIndex].value;
    var select = $('#city-select').val();
    if (select > 0) {
        $.post(url, {selectCity:select, token:$("#ajax_token").val()}, function (result) {
            var arrAction = new Array();
            arrAction = $.parseJSON(result);
            $("#city-select-parent Option").each(function () {
                $(this).remove();
            });
            $.each(arrAction, function (key, value) {
                key = key.substring(1, key.length);
                $('#city-select-parent').append($('<option>', {
                    value:'' + key + '',
                    text:value
                }));
            });
        });
    }
    else {
        $("#city-select-parent Option").remove();
        $('#city-select-parent').append($('<option>', {
            value:'' + '-1' + '',
            text:'---Quận/Huyện/Thị xã---'
        }));
    }
}

// huync2: hien thi cua hang
function showStore(url) {

    var select = ($("#city-select-parent").val());
    $.post(url, {selectCity:select, token:$("#ajax_token").val()}, function (result) {
        $('.title_list_store').show();
        if (result) {
            $('.vt_result').html(result);
        } else {
            $('.vt_result').html('Không có dữ liệu');
        }
    });
}


