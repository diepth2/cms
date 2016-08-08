// HuongND16 Bắt sự kiện ấn nút enter dùng cho nút search và popup đăng nhập
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

function registerEmail(){
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = $('#email').val();
    var link_send = $('#link_send').val();
    var invalid = $('#invalid-email').val();
    if(re.test(email)){
        $.post(link_send, {email: email, token: $("#token-email").val()}, function (result) {
                obj = $.parseJSON(result);
                alert(obj['notice']);
            });
    }
    else {
        alert(invalid);
    }
}