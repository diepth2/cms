$(document).ready(function () {
    $("#generate").click(function(){
        $('#vt_publisher_info_reset_pass_password').val(Math.random().toString(36));
    });
    $('.btn-primary').attr("onClick",  "this.disabled='disabled'; this.form.submit();");
});