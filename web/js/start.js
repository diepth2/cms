/**
 * Created with JetBrains PhpStorm.
 * User: Conghuyvn8x
 * Date: 9/12/13
 * Time: 3:21 AM
 * To change this template use File | Settings | File Templates.
 */

// saveReview(1,2)
function saveReview(val1) {
    $("input[type='button']").attr("disabled","disabled");

    var requestUrl = '/index.php/ajax/saveReview';
    var articleId = $('.articleinp').val();
    /*$.post(
        requestUrl,
        {status:val1, articleId:articleId },
        function (data) {
            $('.response_review').html(data);
            $("input[type='button']").attr("disabled","");
        }
    );*/
    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data: {status:val1, articleId:articleId },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
        // hoan thanh
            $('.response_review').html(data);
            $("input[type='button']").attr("disabled","");
        },
        beforeSend:function () {
            // truoc khi load
            $("input[type='button']").attr("disabled","disabled");
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled","");
            $('.response_review').html('Có lỗi xẩy ra.');
        }
    });
}

function clickRate(val1, val2) {
    $('#rate_hidden').val(val1);
    var requestUrl = '/index.php/ajax/clickRate';
    var articleId = $('.articleinp').val();
    /*$.post(
        requestUrl,
        {rate:val1, articleId:articleId },
        function (data) {
            $('.response_rate').html(data);
        }
    );*/

    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data: {rate:val1, articleId:articleId },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            // hoan thanh
            $('.response_rate').html(data);
        },
        beforeSend:function () {
            // truoc khi load
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $('.response_rate').html('Có lỗi xẩy ra.');
        }
    });

}


function btFeedback() {
    var requestUrl = '/index.php/ajax/btFeedback';
    var articleId = $('.articleinp').val();
    var comment = $('.comment_fb').val();
    var token = $('#base_form__csrf_token').val();
    if (confirmDialog()) {
/*        $.post(
            requestUrl,
            {comment:comment, articleId:articleId, token:token },
            function (data) {
                $('.response_feedback').html(data);
                $('.selfcare_captcha').click();
            }
        );*/


        $.ajax({
            async:false,
            type:"POST",
            url:requestUrl,
            data: {comment:comment, articleId:articleId, token:token },
            timeout:(5000),
            //cache: false,
            //dataType: "json",
            success:function (data) {
                // hoan thanh
                $('.response_feedback').html(data);
                $('.selfcare_captcha').click();
            },
            beforeSend:function () {
                // truoc khi load
            },
//        complete:function () {},
            error:function (objAJAXRequest, strError) {
                $('.response_feedback').html('Có lỗi xẩy ra.');
            }
        });
    }
}


function trim12(str) {
    var str = str.replace(/^\s\s*/, ''),
        ws = /\s/,
        i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
}
function confirmDialog() {
    var captcha = trim12($('.captcha_feedback').val());
    var comment=trim12($('.comment_fb').val());
    if(comment.length>1000){
        alert('Nội dung không không được quá 1000 kí tự.');
        $('comment_fb').focus();
        return false;
    }
    if(comment==''){
        alert('Nội dung không không được bỏ trống.');
        $('comment_fb').focus();
        return false;
    }
    if (captcha == '') {
        alert('Bạn phải nhập vào mã xác nhận! Không chấp nhận ký tự trống!');
        $('captcha_feedback').focus();
        return false;
    }

    return true;
}


jQuery(document).ready(function () {
    $('.selfcare_captcha').click();
    $('.ratings_stars').hover(
        // Handles the mouseover
        function () {
            $('.rate_widget').find('.ratings_vote').removeClass('ratings_vote').addClass('ratings_stars');
            $(this).prevAll().andSelf().addClass('ratings_over');
            $(this).nextAll().removeClass('ratings_vote');
        }
        ,
        // Handles the mouseout
        function () {
            // delete data
            $(this).prevAll().andSelf().removeClass('ratings_over');
            // can't use 'this' because it wont contain the updated data
            var n = $('#rate_hidden').val();
            for (i = 1; i <= n; i++) {
                $('.star_' + i).addClass('ratings_vote');
            }
        }
    );
});
