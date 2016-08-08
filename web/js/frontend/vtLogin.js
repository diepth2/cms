/**
 * Created with JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 10/06/2014
 * Time: 9:29 AM
 * To change this template use File | Settings | File Templates.
 */
var txtPassword = $('#vtp_login_password');
var txtUsername = $('#vtp_login_username');
var txtCaptcha = $('#vtp_login_captcha');
var inpToken= $('#popup-login-token');

function submitLogin() {
    var trimLoginPassword = trim(txtPassword.val());
    var trimInputLoginCaptcha = trim(txtCaptcha.val());
    var trimLoginUser = trim(txtUsername.val());
    var trimToken=trim(inpToken.val());
    var checkeRemeber = 0;
//    if (document.getElementById("vtp_login_remember").checked == true) {
//        checkeRemeber = 1;
//    }
    trimLoginPassword=Base64.encode(trimLoginPassword);

    $.ajax({
        type:"POST",
        url:urlLogin,
        data:{
            token:trimToken,
            inputCaptchaLogin:trimInputLoginCaptcha,
            loginPassword:trimLoginPassword,
            checkRemeber:checkeRemeber,
            loginUser:trimLoginUser
        },
        cache:false,
        success:function (result) {
            var queryCheckUserInfo = JSON.parse(result);
          //alert(queryCheckUserInfo.errorCode);
            var item = '';
            var message=queryCheckUserInfo.message;
            switch (queryCheckUserInfo.errorCode) {

                case '404':
                    //token khong hop le
                    item += "<span>";
                    item += tokenInvalid;//"Token không hợp lệ";
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
                case '-1':
                    //isoftzModal.closePopUp('#login-popup');//goi tu isoftz.modalpopup.js
                    //isoftzModal.show('#register-popup');//goi tu isoftz.modalpopup.js
                    //Tai khoan chua duoc dang ky
                    item += "<span>";
                    item += notRegister1 + " <a href='" + urlRegister + "'> " + notRegister2 + " </a> " + notRegister3;
                    item += "</span>";
                    $('#not-register .error').empty();
                    $('#not-register .error').append(item);
                    break;
                case '0':
                    location.reload();
                    //Dang nhap thanh cong
                    break;
                case '1':
                    //Captcha khong hop le
                    item += "<span>";
                    item += captchaInvalid;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    $('#vtp_login_captcha').focus();
                    var myImageElement = document.getElementById('img_captcha');
                    myImageElement.src = '/captcha?r=' + Math.random();
                    break;
                case '2':
                    //Tài khoản bị khóa
                    item += "<span>";
                    item += lockAccount;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
                case '3':
                    //Dang nhap khong thanh cong
                    item += "<span>";
                    item += loginError;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
                case '4':
                    //Tai khoan chua duoc kich hoat
                    item += "<span>";
                    item += accountNotActive;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
                case '5':
                    //Tai khoan chua duoc kich hoat
                    item += "<span>";
                    item += message;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
                case '6':
                    //Tai khoan chua duoc kich hoat
                    item += "<span>";
                    item += message;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;    
                default:
                    //Dang nhap khong thanh cong
                    item += "<span>";
                    item += accountAndPassError;
                    item += "</span>";
                    $('#message-error .error').empty();
                    $('#message-error .error').append(item);
                    break;
            }
        },
        error:function (request, status, err) {
        }
    });
}
function submitLogout() {
    $.ajax({
        type:"POST",
        url:urlLogout,
        data:{

        },
        cache:false,
        success:function (result) {
            location.reload();
        },
        error:function (request, status, err) {
        }
    });
}

function getOtp(){
    var txtUsername = $('#vtp_register_username');
    $.ajax({
        type:"POST",
        url:urlgetotp,
        data:{
            msisdn: trim(txtUsername.val())
        },
        cache:false,
        success:function (result) {
            var resultError = JSON.parse(result);
            switch (resultError.errorCode) {
                case '0':
                    //Tai khoan chua duoc kich hoat
                    alert(sendOTPSuccess);
                    break;
                case '1':
                    alert(getLimitOTP);
                    break;
                default:
                    alert(sendOTPError);
                    break;
            }
        },
        error:function (request, status, err) {
        }
    });
}

/*
huync2: getOtp cho sdt khi da login
 */

function getOtpLogin(){
    $.ajax({
        type:"POST",
        url:urlgetotp,
        data:{
            msisdn: trim(msisdn)
        },
        cache:false,
        success:function (result) {
            var resultError = JSON.parse(result);
            switch (resultError.errorCode) {
                case '0':
                    //Tai khoan chua duoc kich hoat
                    alert(sendOTPSuccess);
                    break;
                case '1':
                    alert(getLimitOTP);
                    break;		    
                default:
                    alert(sendOTPError);
                    break;
            }
        },
        error:function (request, status, err) {
        }
    });
}
/*
Ngoctv1: js click button and enter login
*/

function openLink(link){
    window.open(link,'_self')
}

