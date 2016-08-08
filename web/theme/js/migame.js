
function confirmSubmit(text,formId){
    if(confirm(text)){
        document.getElementById(formId).submit();     
    }          
}

function clanDetail(formId,clanId,clanValue){    
    document.getElementById(clanId).value= clanValue;     
    document.getElementById(formId).submit();
}

function eventDetail(formId,eventId,eventValue){    
    document.getElementById(eventId).value= eventValue;     
    document.getElementById(formId).submit();
}

function submitForm(form){  
    document.getElementById(form).submit();
}

function submitMemberForm(form, userId, userValue){
    document.getElementById(userId).value= userValue;
    document.getElementById(form).submit();
}

function showMessageBuiding(){
    
    alert('Game này đang được chúng tôi phát triển xin vui lòng quay lại sau !');
}
function showMessageLogin(){
    
    window.location="dangnhap.html";
   
}
function goGame(url,login){
    $.ajax({
        type: 'GET',
        url: '/front.php/ajax/checkLoginAjax',
        data:{
            token: $('#g_login__csrf_token').val()
        },
        success: function(result) {
            var returnResult = JSON.parse(result);
            status = returnResult.status;
                if(status != 1){
                    alert(returnResult.notice);
                    $('body, html').animate({ scrollTop: 0 }, 150);
                    //location.href = "#username";
                    $("#username").focus();
                    //document.getElementByClass('login_span_username').focus();
                } else{
                    window.location = url;
                }
        }
    });
    //if(login == 0){
    //    showMessageLogin();
    //}else{
    //    $(".login_span_username").focus();
    //    alert('Bạn chưa đăng nhập hệ thống');
    //    return false;
    //    //window.location =url;
    //}
}

function goPage(page){
    document.getElementById('mi_page').value=page;
    var form=document.getElementById("mi-form-paging");
    if(form !=null) form.submit();
}

function goPageRight(page){
    document.getElementById('mi_page_right').value=page;
    var form=document.getElementById("mi-form-paging_right");
    if(form !=null) form.submit();
}

function gameflashShowCategory(cate){
    document.getElementById('mi_page').value=1;
    document.getElementById('mi_gameflash_category').value=cate;
    var form=document.getElementById("mi-form-paging");
    if(form !=null) form.submit();
}

function openPopup(url,width,height){
    var newwindow=window.open(url,'windowupload','top=250,left=400,width='+width+',height='+height);
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}

function reLoad(){
    javascript:location.reload(true);
}

function confirmAction(action,link,game){
     
    var text="Bạn chắc chắn muốn đăng xuất hỏi hệ thống ?";
    if(action=='logout'){
        text="Bạn chắc chắn muốn đăng xuất hỏi hệ thống ?";
    }else if(action=='home'){
        text="Bạn chắc chắn muốn quay lại trang chủ ?";
    }else if(action=='gameonline'){
        text="Bạn chắc chắn muốn sang trang Gameonline ?";
    }else if(action=='gameflash'){
        text="Bạn chắc chắn muốn sang trang Game Flash ?";
    }else if(action=='blog'){
        text="Bạn chắc chắn muốn sang trang blog ?";
    }
    if(game==null || game==''){
        if(confirm(text)){
            window.location=link;
            return true;
        }else{
            return false;
        }
    }else{
        window.location=link;
        return true;
    }
   
}

function confirmActionLogout(){
     
    
    var text="Bạn chắc chắn muốn đăng xuất hỏi hệ thống ?";
    
    if(confirm(text)){
        submitForm('migame_logout_account');
        
    }else{
        return false;
    }
    return true;
}



function nextPage(url,isLogin){
    if(isLogin!=null && isLogin=='0'){
        showMessageLogin();

    }else{
        window.location=url;
    }
}
function nextLink(url){   
    window.location=url;   
}
function shoppingAvatar(value){
    document.getElementById("shoppingAvatarValue").value=value;
    document.getElementById("mi-form-paging").submit();
}

function confirmBuyAvatar(value){    
    $(function() {	
        $( "#dialog-shopping-confirm" ).dialog({
            resizable: false,
            height:160,
            width:350,
            modal: true,
            buttons: {
                "Xác thực mua": function() {
                    shoppingAvatar(value);
                },
                "Không mua": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
}   
function onshowTopLevel(){
    document.getElementById('table-top-level').style.display='';
    document.getElementById('table-top-rich').style.display='none';
    document.getElementById('table-top-event').style.display='none';
}   
 
function onshowTopRich(){
    document.getElementById('table-top-level').style.display='none';
    document.getElementById('table-top-rich').style.display='';
    document.getElementById('table-top-event').style.display='none';
}   
function onshowTopEvent(){
    document.getElementById('table-top-level').style.display='none';
    document.getElementById('table-top-rich').style.display='none';
    document.getElementById('table-top-event').style.display='';
}   


