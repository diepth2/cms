(function ($) {
    $(document).ready(function () {
        $('.g_logout').click(function () {
            loadLogout();
        });
    });
})(jQuery);


function loadLoginTrue() {
    $.ajax({
        async:false,
        type:"POST",
        url:requestUrlLoginTrue,
        data:{},
        timeout:(5000),
        success:function (data) {
            var obj = $.parseJSON(data);
            var message = obj.errMessage;
            if (obj.errCode == 0) {
                var username = obj.username;
                $('.g_username').append('Xin chào: ' + username);
                $('.frm_login').hide();
                $('.frm_login_true').show();
                $('.g_register').hide();
            } else {
                $('.frm_login').show();
                $('.g_register').show();
                $('.frm_login_true').hide();
            }
        },
        beforeSend:function () {
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {

        }
    });

}


function loadLogout() {
    $.ajax({
        async:false,
        type:"POST",
        url:requestUrlLogout,
        data:{},
        timeout:(5000),
        success:function (data) {
            var obj = $.parseJSON(data);
            var message = obj.errMessage;
            if (obj.errCode == 1) {
                alert(message)
            } else {
                $('.g_username').html('');
                $('.frm_login').show();
                $('.g_register').show();
                $('.frm_login_true').hide();
                alert(message)
            }
        },
        beforeSend:function () {
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {

        }
    });

}