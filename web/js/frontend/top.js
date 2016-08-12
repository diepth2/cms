$(function(){
    // pageTop
    var pagetop = $('#page-top');
    var stop = $('#footer').offset().top - $(window).height();
    pagetop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            pagetop.fadeIn();
            if ($(this).scrollTop() > stop) {
                pagetop.css({
                    "position": "absolute",
                    "bottom": ($('#footer').height() - 100) + "px"
                });
            } else {
                pagetop.css({
                    "position": "fixed",
                    "bottom": "20px"
                });
            }
        } else {
            pagetop.fadeOut();
        }
    });
    pagetop.click(function () {
        $('body, html').animate({ scrollTop: 0 }, 150);
        return false;
    });
});