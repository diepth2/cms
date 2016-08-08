/**
 * Created with JetBrains PhpStorm.
 * User: Conghuyvn8x
 * Date: 9/17/13
 * Time: 2:44 AM
 * To change this template use File | Settings | File Templates.
 */
function setCategorySbs(val) {
    var requestUrl = '/index.php/ajax/setCategorySbs';
    $.post(
        requestUrl,
        {val:val },
        function (data) {
            window.location.assign(urlCategory + "?act=question");
        }
    );
}

function setAnswerSbs(val, question, checkChange) {
    var requestUrl = '/index.php/ajax/setAnswerSbs';
    var val = val.value;
    $.post(
        requestUrl,
        {val:val, question:question, checkChange:checkChange},
        function (data) {
            window.location.assign(urlCategory + "?act=question");
        }
    );
}

function saveReviewQuestion(status, questionID) {
    var requestUrl = '/index.php/ajax/saveReviewQuestion';
    $.post(
        requestUrl,
        {status:status, questionID:questionID },
        function (data) {
            if (status == 1) {
                $('.response_review').html(data);
                $('.bt_clickno').hide();
            }
            if (status == 0) {
                $('.response_review').html(data);
                $('.bt_clickno').show();
            }

            $("input[name='btyes']").attr("disabled", "disabled");
            $("input[name='btno']").attr("disabled", "disabled");
        }
    );
}


function btChangeQA(question, answer, val) {
    var requestUrl = '/index.php/ajax/btChangeQA';
    $.post(
        requestUrl,
        {question:question, answer:answer },
        function (data) {
            window.location.assign(urlCategory + "?act=question&sl=" + val);
        }
    );
}

