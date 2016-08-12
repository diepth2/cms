/**
 * Created by JetBrains PhpStorm.
 * User: tuanbm
 * Date: 9/10/12
 * Time: 10:20 AM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function () {
  // initialization code goes here
    $('select').select2();
//    $('option').each(function() {
//        var html = '';
//        if ($(this).css('display') !== 'none') {
//            $(this).replaceWith($(" " +  '<option>' + this.innerHTML + '</option>' + "'"));
//        }
//        $(this).parent().show();
//    });
  $(".sf_admin_batch_checkbox").click(function () {
//      if (this.checked == false) {
//        document.getElementById('sf_admin_list_batch_checkbox').checked = false;
//      }
    var checkAll = true;
    $('.sf_admin_batch_checkbox').each(function () {
      if (this.checked == false) {
        checkAll = false;
      }
    });
    if (checkAll == true) {
      document.getElementById('sf_admin_list_batch_checkbox').checked = true;
    } else {
      document.getElementById('sf_admin_list_batch_checkbox').checked = false;
    }
  });

  $('div.control-group input:text:not([readonly]):not([disabled])').eq(0).focus();
  $('div.sf_admin_form_row.error input').eq(0).focus();
  $('div.control-group.error input').eq(0).focus();

//    $('input[rel="datepicker"]').daterangepicker({
//        format: 'DD/MM/YYYY'
//    });

});

function sendMail(it, box) {
  var visible = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = visible;
}


function checkOne() {
  var checked = true;
  $('.sf_admin_batch_checkbox_rank').each(function () {
    if ($(this).is(':checked') == false) {
      checked = false;
    }
  });
  $('#sf_admin_list_batch_checkbox_rank').attr('checked', checked);
}

function checkAllRank() {
  var listrank = document.getElementsByTagName('input');
  for (var index = 0; index < listrank.length; index++) {
    box = listrank[index];
    if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox_rank') {
      box.checked = document.getElementById('sf_admin_list_batch_checkbox_rank').checked;
    }
  }
  return true;
}


/**
 * check batchAction
 * @author vos_khanhnq16
 * @param value
 * @param messageConfirm
 * @param messageAlert
 */

function setBatchActionValue(value, messageConfirm, messageAlert) {
  if(messageConfirm == undefined || messageAlert == undefined){
    alert("Chưa truyền message");
    return false;
  }
  $('#batch_action_input').val(value);
  var itemChecker = false;
  if (value == 'batchDelete')
  {
    $('.sf_admin_batch_checkbox').each( function(){
      if (this.checked == true) {                    {
        itemChecker = true;
//                      break;
      }
      }
    });

    if(itemChecker == true){
      var agree = confirm(messageConfirm);
      if(agree)
        return true;
    } else{
      alert(messageAlert);
    }
    return false;
  }
}

function CheckIsNumeric(input)
{
//  duynt10 : them dieu kien input phai khac 0 vao
    return (input - 0) == input && input.length > 0 && input != 0;
}

/**
 tuanbm
 */
function checkValidateOnSaveAlbum(){
    var allow=true;
    $(".checkValidateOrderNumber").each(function(){
        if(CheckIsNumeric(this.value)==false){
//            alert("Trường số thứ tự "+this.value+" không phải là số.")
            $(this).next("span").show();
            this.focus();
            allow = false;
        }else if(this.value<0){
            $(this).next("span").show();
            this.focus();
            allow = false;
        }
    })
    return allow;
}
/**
 * @author vos_loilv4
 * Check gia tri checkbox sf_admin_batch_checkbox_rank
 * @param value
 * @param messageConfirm
 * @param messageAlert
 */
function setBatchActionValueRank(value, messageConfirm, messageAlert) {
  if(messageConfirm == undefined || messageAlert == undefined){
    alert("Chưa truyền message");
    return false;
  }
  $('#batch_action_input_rank').val(value);
  var itemChecker = false;
  if (value == 'batchDelete')
  {
    $('.sf_admin_batch_checkbox_rank').each( function(){
      if (this.checked == true) {                    {
        itemChecker = true;
      }
      }
    });

    if(itemChecker == true){
      var agree = confirm(messageConfirm);
      if(agree)
        return true;
    } else{
      alert(messageAlert);
    }
    return false;
  }
}
