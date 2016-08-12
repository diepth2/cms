// HuongND16 B?t s? ki?n ?n nút enter dùng cho nút search và popup ??ng nh?p
$(document).ready(function() {
    $('div.control-group input:text:not([readonly]):not([disabled])').eq(0).focus();
    $(".form-control vtt-login-username").focus();
  $("input[class='form-control vtt-login-pass error']").eq(0).focus();
  $("input[class='form-control vtt-login-username error']").eq(0).focus();

  $('div.control-group.error input').eq(0).focus();
    if (navigator.appName === "Microsoft Internet Explorer") {
        $('input, textarea').placeholder();
//        $('input, textarea').placeholder({customClass: 'my-placeholder'});
    }
})