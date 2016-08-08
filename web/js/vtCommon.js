function getEmailTemplate(value){
    if (value == 2){
	emailType = "app_vt_gift_order_approve_email";
    }
    else if(value == 1) {
	emailType = "app_vt_gift_order_deny_email";
    }
    $.post("/backend_dev.php/ajax/getEmailTemplate",{
	emailType:emailType
    },function(result){
	var myEditor = CKEDITOR.instances.vt_gift_order_email;//email la id cua textarea
	myEditor.setData(result);	
	if(value!=1 && value!=2){
	    myEditor.setData("");
	}
    });
}

/* set email ChuyenNV2 */
function setEmailTemplateForPlaylist(){
    emailType="app_vt_playlist_email";
    $.post("/backend_dev.php/ajax/getEmailTemplate",{
	emailType:emailType
    }, function(result){
		var myEditor=CKEDITOR.instances.contact_body;
		myEditor.setData(result);
	    });
}


/*Json to table start---------------------------------------------------------*/
function CreateTable(objArray, theme, enableHeader) {
    // set optional theme parameter
    if (theme === undefined) {
	theme = 'ViettelLove'; //default theme
    }
 
    if (enableHeader === undefined) {
	enableHeader = true; //default enable headers
    }
 
    // If the returned data is an object do nothing, else try to parse
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
 
    var str = '<table class="' + theme + '">';
 
    // table head
    if (enableHeader) {
	str += '<thead><tr>';
	for (var index in array[0]) {
	    str += '<th scope="col">' + index + '</th>';
	}
	str += '</tr></thead>';
    }
 
    // table body
    str += '<tbody>';
    for (var i = 0; i < array.length; i++) {
	str += (i % 2 == 0) ? '<tr class="alt">' : '<tr>';
	for (var index in array[i]) {
	    str += '<td>' + array[i][index] + '</td>';
	}
	str += '</tr>';
    }
    str += '</tbody>'
    str += '</table>';
    return str;
}
/**
 * Thuc hien bat ky tu enter trong popup
 * @author:loilv4
 * @created_at:24/04/2013
 */
jQuery(document).ready(function() {
    $('#vtModalInput_sf_guard_user_groups_list').keypress('13',function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13'){
            e.preventDefault();
            javascript:ProcessData(  'sf_guard_user_groups_list','searchGuardGroupName', 1)
        }
    })
    $('#vtModalInput_vt_camera_group_user_list').keypress('13',function(e){
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13'){
            e.preventDefault();
            javascript:ProcessData(  'vt_camera_group_user_list','searchGuardGroupName', 1)
        }
    })
});
/*Json to table start end-----------------------------------------------------*/



