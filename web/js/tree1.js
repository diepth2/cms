/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 8/30/13
 * Time: 4:30 PM
 * To change this template use File | Settings | File Templates.
 */

/*
 huync2: save thong tin question
 */
var loadtree = '<div class="loadTree" style="margin: 0px auto;line-height: 100px;font-weight: bold;">Loading</div>';
function btSaveQuestion() {
    var requestUrl = '/index.php/ajax/btSaveQuestion';
    var question = trim12(document.getElementById('question').value);

    var question_control = trim12(document.getElementById('question_control').value);
    var question_control1 = trim12(document.getElementById('question_control1').value);
//    var question_control1 = trim12(document.getElementById('question_control1').value);
    var category = '';
    if (question_control == question_control1)
        category = trim12(document.getElementById('category').value);
    var isActive = 0;
    if (question == '') {
        alert('Câu hỏi không được để trống.');
        return false;
    }
    if (question.length > 1000) {
        alert('Câu hỏi không được quá 1000 kí tự.');
        return false;
    }
    $("input[type='button']").attr("disabled", "disabled");

    if ($('#isActive').is(':checked'))
        isActive = 1;

    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data:{question:question, category:category, isActive:isActive, question_control:question_control },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            // hoan thanh
            $("input[type='button']").attr("disabled", false);
            var obj = eval("(" + data + ")");
            var status = obj.status;
            if (status == 1) {
                var id = obj.id;
                $('#tree_q_' + id).text(question).html();
                var msg = obj.mes;
                alert(msg);
            }
            if (status == 2) {
                var msg = obj.mes;
                alert(msg);
            }
        },
        beforeSend:function () {
            // truoc khi load
            $("input[type='button']").attr("disabled", "disabled");
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled", false);
            alert('Có lỗi xẩy ra.');
        }
    });
}

function btDelQuestion() {
    var rConfirm = confirm('Bạn có thực sự muốn xóa câu hỏi này?');
    if (rConfirm) {
        $("input[type='button']").attr("disabled", "disabled");
        var requestUrl = '/index.php/ajax/btDelQuestion';
        var question_control = trim12(document.getElementById('question_control').value);
        var question_control1 = trim12(document.getElementById('question_control1').value);

        $.ajax({
            async:false,
            type:"POST",
            url:requestUrl,
            data:{question_control:question_control },
            timeout:(5000),
            //cache: false,
            //dataType: "json",
            success:function (data) {
                // hoan thanh
                $("input[type='button']").attr("disabled", false);
                var obj = eval("(" + data + ")");
                var status = obj.status;
                if (status == 1) {
                    var msg = obj.mes;
                    alert(msg);
                    if (question_control != question_control1) {
                        window.location.reload();
                    }
                    else {
                        window.location.assign(urlRedirect + "/index?act=true");
//                        window.location.assign("/admin.php/service/self-services/self-service-questions/index?act=true");
                    }
                }
                if (status == 2) {
                    var msg = obj.mes;
                    alert(msg);
                }
            },
            beforeSend:function () {
                // truoc khi load
                $("input[type='button']").attr("disabled", "disabled");
            },
//        complete:function () {},
            error:function (objAJAXRequest, strError) {
                $("input[type='button']").attr("disabled", false);
                alert('Có lỗi xẩy ra.');
            }
        });
    }
}
/*
 huync2: load thong tin cau hoi và ds cau tra loi
 */

function treeClickQuestion(idQuestion, status, idAnswer) {
    var requestUrl = '/index.php/ajax/treeClickQuestion';
    var question_control = document.getElementById('question_control').value;
    if (idQuestion != question_control) {
        $('.loadResult').html(loadtree);
        $('.showResult').hide();

        $.ajax({
            async:false,
            type:"POST",
            url:requestUrl,
            data:{idQuestion:idQuestion, status:status, idAnswer:idAnswer, question_control:question_control },
            timeout:(5000),
            //cache: false,
            //dataType: "json",
            success:function (data) {
                // hoan thanh
                $("input[type='button']").attr("disabled", false);
                if (data != 1) {
                    if (data == 2)
                        alert('Không load được dữ liệu');
                    else {
                        $('.loadResult').html('');
                        $('.showResult').html(data);
                        $('.showResult').show();
                        $('.treeviewQuestionAnswerControl_addAnswer_main').hide();
                        $('.treeviewQuestionAnswerControl_editAnswer_main').hide();
                    }
                }
            },
            beforeSend:function () {
                // truoc khi load
                $("input[type='button']").attr("disabled", "disabled");
            },
//        complete:function () {},
            error:function (objAJAXRequest, strError) {
                $("input[type='button']").attr("disabled", false);
                $('.loadResult').html('');
                $('.showResult').show();
                alert('Có lỗi xẩy ra.');
            }
        });
    }
}


/*
 huync2
 luu thong tin them cau tra loi
 */
function btSaveQuestionAnswer(val) {
    var nextQuestion = trim12(document.getElementById('nextQuestion').value);
    var answer = trim12(document.getElementById('answer').value);
    var question_control = trim12(document.getElementById('question_control').value);

    if (answer == '') {
        alert('Câu trả lời không được để trống.');
        return false;
    }
    if (answer.length > 1000) {
        alert('Câu trả lời không được quá 1000 kí tự.');
        return false;
    }
    if (nextQuestion.length > 1000) {
        alert('Câu hỏi không được quá 1000 kí tự.');
        return false;
    }
    $("input[type='button']").attr("disabled", "disabled");

    var requestUrl = '/index.php/ajax/btSaveQuestionAnswer';
    var status = 3;
    var checkHident = 1;

    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data:{nextQuestion:nextQuestion, answer:answer, question_control:question_control },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            // hoan thanh
            $("input[type='button']").attr("disabled", false);
            var obj = eval("(" + data + ")");
            status = obj.status;
            if (status == 1) {
                var msg = obj.mes;
                var nextQuestionId = obj.nextQuestion;
                var question_controlId = obj.question_control;
                var answerId = obj.answer;
                // tao node
                var html = getHtmlNode(nextQuestion, answer, question_controlId, nextQuestionId, answerId, checkHident);
//                $('.tree li').find('a.activeClick').parent().append(html);
//                alert(html);
                $('#tree_q_' + question_control).parent().append(html);

                $('#tree_a_' + answerId).text(answer).html();
                $('#tree_q_' + nextQuestionId).text(nextQuestion).html();

                alert(msg);
                addRowTableAddQuestion(answer, nextQuestion, answerId, '');
                // sp_tb_a_
                $('#sp_tb_a_' + answerId).text(answer).html();
                $('#sp_tb_q_' + answerId).text(nextQuestion).html();

                $('#nextQuestion').val('');
                $('#answer').val('');
            }
            if (status == 2) {
                var msg = obj.mes;
                alert(msg);
            }
        },
        beforeSend:function () {
            // truoc khi load
            $("input[type='button']").attr("disabled", "disabled");
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled", false);
            alert('Có lỗi xẩy ra.');
        }
    });
}


function btUpdateQuestionAnswer(val1, val2, val3) {

    var nextQuestionUd = trim12(document.getElementById('nextQuestionUpdate').value);
    var answerUd = trim12(document.getElementById('answerUpdate').value);

    if (answerUd == '') {
        alert('Câu trả lời không được để trống.');
        return false;
    }
    if (answerUd.length > 1000) {
        alert('Câu trả lời không được quá 1000 kí tự.');
        return false;
    }

    if (nextQuestionUd.length > 1000) {
        alert('Câu hỏi tiếp theo không được quá 1000 kí tự.');
        return false;
    }
    $("input[type='button']").attr("disabled", "disabled");

    var requestUrl = '/index.php/ajax/btUpdateQuestionAnswer';

    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data:{answer:val1, question:val2, answerUd:answerUd, nextQuestionUd:nextQuestionUd  },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            // hoan thanh
            $("input[type='button']").attr("disabled", false);
            if (data) {
                var obj = eval("(" + data + ")");
                var status = obj.status;
                if (status == 1) {
                    var msg = obj.mes;
                    var idNextQuestionReturn = obj.idNextQuestion;
                    alert(msg);
                    /*var table = document.getElementById("tbAddQuestion");
                     var a = $('#tbAddQuestion tr').find("tr:3");
                     alert(a.html());*/
                    $('#tbAddQuestion tr').eq(val3).remove();
                    addRowTableAddQuestion(answerUd, nextQuestionUd, val1, val3);
                    // sp_tb_a_
                    $('#sp_tb_a_' + val1).text(answerUd).html();
                    $('#sp_tb_q_' + val1).text(nextQuestionUd).html();

                    // add them cau hoi vao node da bi an do cau hoi bi sua null nhung van co id
                    if (val2 == idNextQuestionReturn) {
                        $('#tree_q_' + val2).text(nextQuestionUd).html();
                        $('#tree_q_' + val2).parent().show();
                    }
                    else {
                        if (idNextQuestionReturn != '') {
                            // add node question vao cau tra loi khi no khong co cau hoi(ko co id bi an)
                            var htmlNode = getHtmlNodeUpdate(val1, idNextQuestionReturn, nextQuestionUd);
//                        alert($('#tree_a_' + val1).parent().html());
                            $('#tree_a_' + val1).parent().append(htmlNode);
                            $('#tree_q_' + idNextQuestionReturn).text(nextQuestionUd).html();
                        } else {
//                            $('#tree_q_' + val2).parent().parent().html('');
                            $('#tree_q_' + val2).parent().parent().html('');
                        }
                    }
                    $('#tree_a_' + val1).text(answerUd).html();
                }
                if (status == 2) {
                    var msg = obj.mes;
                    alert(msg);
                }
            }
        },
        beforeSend:function () {
            // truoc khi load
            $("input[type='button']").attr("disabled", "disabled");
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled", false);
            alert('Có lỗi xẩy ra.');
        }
    });
}

function btEditAnswer(val1, val2) {
    $('.treeviewQuestionAnswerControl_addAnswer_main').hide();
    $('.treeviewQuestionAnswerControl_editAnswer_main').show();
    $('.treeviewQuestionAnswerControl_editAnswer_main').html(loadtree);
    var requestUrl = '/index.php/ajax/btEditAnswer';
    $("input[type='button']").attr("disabled", "disabled");
    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data:{answer:val1, val:val2 },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            $("input[type='button']").attr("disabled", false);
            // hoan thanh
            if (data) {
                $('.treeviewQuestionAnswerControl_editAnswer_main').html(data);
            }
        },
        beforeSend:function () {
            // truoc khi load
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled", false);
            $('.treeviewQuestionAnswerControl_editAnswer_main').html('');
            alert('Có lỗi xẩy ra.');
        }
    });
}

function btDeleteQuestionAnswer(answerId, nextQuestionId, val) {
    var requestUrl = '/index.php/ajax/btDeleteQuestionAnswer';
    $.ajax({
        async:false,
        type:"POST",
        url:requestUrl,
        data:{answerId:answerId },
        timeout:(5000),
        //cache: false,
        //dataType: "json",
        success:function (data) {
            // hoan thanh
            $("input[type='button']").attr("disabled", false);
            var obj = eval("(" + data + ")");
            var status = obj.status;
            if (status == 1) {
                var msg = obj.mes;
                alert(msg);
                $('#tree_a_' + answerId).parent().hide();
                $('#sp_tb_a_' + answerId).parent().parent().hide();
                $('.treeviewQuestionAnswerControl_editAnswer_main').hide();
            }

            if (status == 2) {
                var msg = obj.mes;
                alert(msg);
            }
        },
        beforeSend:function () {
            // truoc khi load
            $("input[type='button']").attr("disabled", "disabled");
        },
//        complete:function () {},
        error:function (objAJAXRequest, strError) {
            $("input[type='button']").attr("disabled", false);
            alert('Có lỗi xẩy ra.');
        }
    });
}

function trim12(str) {
    var str = str.replace(/^\s\s*/, ''),
        ws = /\s/,
        i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
}


var objNodeQA = false;
function onclickNodeQAEM(val) {
    $(val).parent().children('ul').slideToggle('fast');
    $(val).toggleClass('action');
}

function onclickNodeQAA(val) {
    $('.tree li').find('a.activeClick').removeClass('activeClick');
    $(val).addClass('activeClick');
    objNodeQA = true;
}

function getHtmlNode(nextQuestion, answer, question_controlId, nextQuestionId, answerId, checkHident) {
    var html = '';

    var strTree = $('#tree_q_' + question_controlId).parent().html();
    var strEm = strTree.substr(0, 60);
    if (strEm.indexOf('action') >= 0) {
        checkHident = 2;
    }

    if (checkHident == 2)
        html += "<ul style='display: block;'>";
    else
        html += "<ul style='display: none;'>";

    html += " <li class='parent'><em onclick='onclickNodeQAEM(this);treeClickQuestion(" + question_controlId + ",1," + answerId + ")'></em> <a onclick='onclickNodeQAA(this)' id='tree_a_" + answerId + "'></a>";
    if (nextQuestion != '') {
        html += "<ul>";
        html += " <li><em onclick='onclickNodeQAEM(this)'></em><a onclick='onclickNodeQAA(this);treeClickQuestion(" + nextQuestionId + ",1," + nextQuestionId + ")' id='tree_q_" + nextQuestionId + "'></a>";
        html += "</li>";
        html += "</ul>";
    }
    html += "</li>";
    html += "</ul>";

    return html;
}

function getHtmlNodeUpdate(answerId, nextQuestionId, nextQuestionName) {
    // check hident
    if (nextQuestionName != '') {
        var strTree = $('#tree_a_' + answerId).parent().html();
        var strEm = strTree.substr(0, 30);
        var checkHident = 1;
        if (strEm.indexOf('action') >= 0) {
            checkHident = 2;
        }

        var html = '';
        if (checkHident == 2)
            html += "<ul style='display: block;'>";
        else
            html += "<ul style='display: none;'>";

        html += " <li><em onclick='onclickNodeQAEM(this)'></em><a onclick='onclickNodeQAA(this);treeClickQuestion(" + nextQuestionId + ",1," + nextQuestionId + ")' id='tree_q_" + nextQuestionId + "'></a>";
        html += "</li>";
        html += "</ul>";

        return html;
    }
}

function title_addQuestion() {
    $('.treeviewQuestionAnswerControl_addAnswer_main').slideToggle('show');
    $('.treeviewQuestionAnswerControl_editAnswer_main').hide();
}

function addRowTableAddQuestion(val1, val2, val3, val4) {
    var table = document.getElementById("tbAddQuestion");
    var n = $('#tbAddQuestion tr').length;
    var length = val4 == '' ? n : val4;

    var row = table.insertRow(length);
//    var row = table.insertRow($('#tbAddQuestion tr').length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = '<span id="sp_tb_a_' + val3 + '">' + val1 + '</span>';
    cell2.innerHTML = '<span id="sp_tb_q_' + val3 + '">' + val2 + '</span>';
    cell3.innerHTML = '<input type="button" class="span_edit_answer btn btn-small" value="Edit" onclick="btEditAnswer(' + val3 + ',' + length + ')">';
//    cell3.innerHTML = '<span class="span_edit_answer" onclick="btEditAnswer(' + val3 + ',' + length + ')">Edit</span>';
}


(function ($) {
    var objClick;


    $(document).ready(function () {
        $('.title_addQuestion').click(function () {
            $('.treeviewQuestionAnswerControl_addAnswer_main').slideToggle('slow');
            $('.treeviewQuestionAnswerControl_editAnswer_main').hide();

        });

        $('.tree li').each(function () {
            if ($(this).children('ul').length > 0) {
                $(this).addClass('parent');
            }
        });


        $('.tree li.parent em').toggle(function () {
            $(this).addClass('action');
        }, function () {
            $(this).removeClass('action');
        });
        $('.tree li.parent em').click(function () {
            $(this).parent().children('ul').slideToggle('fast');
        });

        $('.tree li a').click(function () {
            $('.tree li').find('a.activeClick').removeClass('activeClick');
            $(this).addClass('activeClick');
            objClick = $(this);
        });
    })
})(jQuery);