//$(function() {
//    $(".datepicker").datepicker();
//
//    }
// );
//alert(123);
//$('input[type=submit]').one('submit', function() {
//    $(this).attr('disabled','disabled');

function trim(str) {
    str = str.replace(/^\s\s*/, '');
    var ws = /\s/,
    i = str.length;
    while (ws.test(str.charAt(--i)));
    return str.slice(0, i + 1);
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, "&#039;");;
}

function Tip(divId){
    document.getElementById(divId).style.display='block';
}
function UnTip(divId){
    document.getElementById(divId).style.display='none';
}

function showDiv(divId){
    document.getElementById(divId).style.display='block';
}
//---- ham kiem tra xem mot obj co la date ko
function isDateFormat(value) 
{ 
    var date=value.substr(0,10);                

    // Regular expression used to check if date is in correct format 
    var pattern = new RegExp(/^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/); 

    // kiem tra date
    if(date.match(pattern)){ 
        var date_array = date.split('/');            
        var day = date_array[0]; 

        // Attention! Javascript consider months in the range 0 - 11 
        var month = date_array[1] - 1; 
        var year = date_array[2]; 

        // This instruction will create a date object 
        var source_date = new Date(year,month,day);

        if(year != source_date.getFullYear()) 
        { 
            return false; 
        } 

        if(month != source_date.getMonth()) 
        { 
            return false; 
        } 

        if(day != source_date.getDate()) 
        { 
            return false; 
        } 
    }else {
        return false; 
    }

    // kiem tra time

    if(value.length>10){

        var time=value.substr(11);

        if(time.length ==8){

            var hour=time.substr(0,2);

            var minute=time.substr(3,2);

            var second=time.substr(6);
            if(parseInt(hour, 10) > 23 && parseInt(hour, 10) < 0){
                return false;
            }
            if(parseInt(minute, 10) > 60 && parseInt(minute, 10) < 0){
                return false;
            }
            if(parseInt(second, 10) > 60 && parseInt(second, 10) < 0){
                return false;
            }
        }else{
            return false;
        }

    }
    return true; 

}

/**
 * validate Date
 * khanhnq16
 */
function validateDate(obj,msg){

    var checkString = obj.value;

    checkString = trimAll(checkString);

    if (checkString != ""){
        var strMsg = (msg != null && msg != undefined) ? msg : 'Dữ liệu ngày tháng phải theo định dạng dd/mm/yyyy';
        if (!isDateFormat(checkString)){
            alert (strMsg);
            setTimeout(function(){
                obj.focus();
                obj.select();
            },0);
            return false;
        }
    }
    return true;
}

/**
 * view more comment
 * @author vos_khanhnq16
 */


/**
 * function send comment
 * @author vos_khanhnq16
 */
function sendComment(type, objectId){
    var content = $('#commentContent').val();
    if(content.trim().length > 500){
        $('.italic').html('Tối đa 500 kí tự');
        $('.italic').css('color','red');
        return false;
    } else if(content.trim().length == ""){
        $('.italic').css('color','red');
        $('.italic').html('yêu cầu nhập bình luận');
        return false;
    }else{
        $('.italic').html('Tối đa 500 kí tự');
        $('.italic').css('color','inherit');
    }
    $("#processingContainerComment").show();
    $.get("/gui-binh-luan",{slug: objectId, type: type, comment:content},
    function(result){
        $("#processingContainerComment").hide();
        alert(result);
        $('#commentContent').val('');
    });
}

 /**
 * cat cac ky tu space o 2 dau va thay the cac space lien nhau thanh 1 space
 * @author vos_khanhnq16
 */
function trimObject(string){
    if (string == null || string == undefined){
        return;
    }
    string.value = string.value.trim().replace(/\s+/g, " ");
}

function trimAll(sString) {
    if(sString == null)
        return sString;
    return trim(sString);
}



function checkMobile(isdn) {
    var re = /^8496\d{7}$|^8497\d{7}$|^8498\d{7}$|^8416\d{8}$|^0?96\d{7}$|^0?97\d{7}$|^0?98\d{7}$|^0?16\d{8}$/;
    return re.test(isdn);
}
function checkPassIshare(val) {
    var re = /\d{8}$/;
    return re.test(val);
}

function checkPassIshareReset(val) {
    var re = /^[0-9]+$/;
    return re.test(val);
}

function isPSTNNumber(phone) {
    var pattern = /^0(76|75|64|281|240|781|241|56|650|651|62|780|710|26|67|511|61|500|501|230|59|219|351|39|711|218|321|8|320|31|58|77|60|231|63|25|20|72|30|68|350|38|210|57|52|510|55|33|53|79|22|66|36|280|54|37|73|74|27|70|211|29|4)[0-9]+$/;
    return pattern.test(phone);
}
function in_array(v, arr) {
    var r = false;
    for (index in arr) {
        if (arr[index] == v) {
            r = true; break;
        }
    }
    return r;
}
