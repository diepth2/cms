$(document).ready(function() {
    /* Biến lưu mã lỗi khi gửi tin nhắn cho KH
    * Nếu có lỗi =-1 thì ko lưu: tin nhắn vào vt_bulksms_content và KH vào vt_bulksms_request
    * */
    var error_code = -1;
//    var ids_g = '';
    /* Chọn thời gian gửi tin nhắn, in file: pageSendSms/templates/_leftSecondPage */
    $("#vt_bulksms_content_schedule_at").datetimepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        showButtonPanel: true,
        minDate: 0,
        maxDate: 1000
    });

    //trungpd2
    $('#vt_bulksms_content_content').on('blur click', function(){
        $(this).attr('maxlength', 480);
    });
    $('#vt_bulksms_content_content').keydown(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == 13) {
            return false;
        }
    });
    $('#vt_bulksms_content_content').on('input paste',function(){
        var len = $(this).val().length;
        var numsms =  Math.ceil(len/160);
        $('#contentNumSms').text(len + "/" + numsms);
    });//trungpd2

    $('#select_all_list_bulk_group').change(function() {
        $(':checkbox').each(function() {
            this.checked = $('#select_all_list_bulk_group').is(':checked');
        });
    });

    //trungpd2: tìm kiếm khách hàng theo điều kiện

    $('#contact-group-name').keyup(function (e) {
        if (e.keyCode == 13) {
            $( "#btn-search-contact" ).click();
        }
    });
    $('#contact-group-phone').keyup(function (e) {
        if (e.keyCode == 13) {
            $( "#btn-search-contact" ).click();
        }
    });
    $('#filter-contact-group').change(function () {
        $( "#btn-search-contact" ).click();
    });
    $("#btn-addCustomerGroup").click(function() {
        $("#groupName-err").html("");
        $("#groupName").val("");
        $("#groupNote").val("");
    });

    $("#btn-addBrandName").click(function() {
        $("#ajax-error").html("");
        $("#bulksms-brandname").val("");
    });

    /* Nhấn gửi tin nhắn cho KH */
    $("#btn-SendSMS").click(function(){

        var size = $("#div-contact-receive-sms tbody .vtt-center").size();
        // var ids_g = '';
        if (size) {
            var title = trim($("#vt_bulksms_content_title").val());
            var brandname = trim($("#vt_bulksms_content_brandname_id :selected").text());
            var brandname_id = $("#vt_bulksms_content_brandname_id").val();
            var content = trim($("#vt_bulksms_content_content").val());
            var content_type_id = $("#vt_bulksms_content_type_id").val();
            var schedule_at = $("#vt_bulksms_content_schedule_at").val();
            //
            var url = '/frontend.php/ajax/confirmReceiveSMS';
            var token = $("#token-bulksms").val();
            var array_group_ids = ids_g;
            var array_ids = ids;
            $.ajax({
                type: "POST",
                url: url,
                data:{
                    title: title,
                    brandname: brandname,
                    brandname_id: brandname_id,
                    content: content,
                    content_type_id: content_type_id,
                    schedule_at: schedule_at,
                    group_ids: array_group_ids,
                    ids: array_ids,
                    token: token
                },
                cache: false,
                success: function (result) {
                    var data = JSON.parse(result);
                    if(data.status == -2 ){
                        location.reload();
                    }
                    if(data.status != 1){
                        $(".form-content").html(data.content);
                    }else if(data.status == 1){
                        $("#brandname-modal").text(brandname);
                        $("#schedule_at-modal").text(schedule_at);
                        $("#content-modal").text(data.content_convert);
                        $("#total-contact").text(data.total_contact);
                        $("#total-costs").text(data.price);

                        $("#ajax-error").html('');
                        $(".form-content").html('');
                        $("#confirmSendSMSModal").modal('show');
                    }
                }
            });
        }else {
            alert('Không có khách hàng nào được chọn');
            e.preventDefault();
            return false;
        }



    });

    $("#btn-confirmSendSMS").click(function(){
        var title = trim($("#vt_bulksms_content_title").val());
        var brandname = trim($("#vt_bulksms_content_brandname_id").text());
        var brandname_id = $("#vt_bulksms_content_brandname_id").val();
        var content = trim($("#vt_bulksms_content_content").val());
        var content_type_id = $("#vt_bulksms_content_type_id").val();
        var schedule_at = $("#vt_bulksms_content_schedule_at").val();
        //
        var url = '/frontend.php/ajax/sendSMSAndSaveDB';
        var token = $("#token-bulksms").val();
        var array_group_ids = ids_g;
        var array_ids = ids;
        $("#confirmSendSMSModal").modal('hide');

        $.ajax({
            type: "POST",
            url: url,
            data:{
                title: title,
                brandname: brandname,
                brandname_id: brandname_id,
                content: content,
                content_type_id: content_type_id,
                schedule_at: schedule_at,
                group_ids: array_group_ids,
                ids: array_ids,
                token: token
            },
            cache: false,
            success: function (result) {
                var data = JSON.parse(result);
                error_code = data.error;
                checkStatus(data.status);
                if(data.status == 1){
                    //alert("Tin nhắn của bạn đã được lưu và chờ duyệt để gửi");
                    $(".form-content").html("");
                    $("#confirmSendSMSModal").modal("hide");
                    url = '/frontend.php/ajax/loadContentRequestSmsPagination'
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            pageId: 0,
                            token: token
                        },
                        cache: false,
                        success: function (result) {
                            $("#div-content-sms-info").html(result);
                        }
                    });
                    $("#publisher_money").text(data.publisher_money + "VND");
                    $('#myTab a[href="#thong-ke"]').tab('show');
                } else {
                    alert(data.notice);
                }
            }
        });
    });

    // trungpd2: Thêm mới BrandName
    $("#btn-add-brand-popup").click(function(){
        var brandname = trim($("#bulksms-brandname").val());
        var url = '/frontend.php/ajax/addBrandName';
        var token = $("#token-bulksms").val();
        //$("#ajax-error").html("");
        $.ajax({
            type: "GET",
            url: url,
            data:{
                brandname: brandname,
                token: token
            },
            cache: false,
            success: function (result) {
                var data = JSON.parse(result);
                if(data.status == 1){
                    $("#list-brandName").append('<tr>' +
                        '<td class="vtt-center">' +  ($("#list-brandName tr").size() + 1) + '</td>' +
                        '<td class="vtt-center" id="brand-name-'+ data.brand_id + '">' + brandname + '</td>' +
                        '<td class="vtt-center" id ="brand-status-' + data.brand_id + '">' + "Chờ duyệt" + '</td>' +
                        '<td class="vtt-center">' +
                        '<a href="javascript:void(0);" title="Sửa"><span class="glyphicon glyphicon-edit update-brand-name-info" id="'+data.brand_id+'"></span></a>' +
                        '<a href="javascript:void(0);" title="Xóa"><span class="glyphicon glyphicon-remove delete-brand-name-info" id="'+ data.brand_id +'"></span></a>' +
                        '</td>' +
                        '</tr>"');
                    $("#addBrandNameModal").modal("hide");
                }else if (data.status == -2){
                    location.reload();
                } else{
                    $("#ajax-error").html(data.notice);
                }
            }
        });
    });

  // sonln3: Gia hạn BrandName
  $(".adjourn-brand-name-info").click(function(){
    var brand_id = $(this).attr('id');
    var token = $("#token-bulksms").val();
    var url = '/frontend.php/ajax/adjournBrandName';
    if (confirm('Bạn có chắc chắn muốn gia hạn không ?')) {
    $.ajax({
      type: "GET",
      url: url,
      data:{
        brand_id: brand_id,
        token: token
      },
      cache: false,
      success: function (result) {
        var data = JSON.parse(result);
        if(data.status == 1){
          alert(data.notice);
          location.reload();
        }else if (data.status == -2){
          location.reload();
        }else if (data.status == 2){
          alert(data.notice);
        } else{
          $("#ajax-error").html(data.notice);
        }
      }
    });
    }
  });

  // sonln3: Xoa BrandName
  $(".delete-brand-name-info").click(function(){
    var brand_id = $(this).attr('id');
    var token = $("#token-bulksms").val();
    var url = '/frontend.php/ajax/deleteBrandName';
    if (confirm('Bạn có chắc chắn muốn xóa Brandname không ?')) {
      $.ajax({
        type: "GET",
        url: url,
        data:{
          brand_id: brand_id,
          token: token
        },
        cache: false,
        success: function (result) {
          var data = JSON.parse(result);
          if(data.status == 1){
            alert(data.notice);
            location.reload();
          }else if (data.status == -2){
            location.reload();
          }else if (data.status == 2){
            alert(data.notice);
          } else{
            $("#ajax-error").html(data.notice);
          }
        }
      });
    }
  });
    //trungpd2: Hiển thị popup cập nhật brandname
    $(document).on( "click",".update-brand-name-info", function() {
        var brand_id = $(this).attr('id');
        var token = $("#token-bulksms").val();
        $("#update-ajax-error").html("");
        $.ajax({
            type: 'GET',
            url: '/frontend.php/ajax/getBrandNameInfo',
            data:{
                brand_id: brand_id,
                token: token
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                status = returnResult.status;
                checkStatus(status);
                $('#updateBrandNameModal').modal('show');
                $('#update-brandName').val(returnResult.brandname);
                $('#update-brandId').val(returnResult.brand_id);
            }
        })
    });

    //trungpd2: Cập nhật BrandName bị từ chối duyệt
    $("#btn-update-brand-popup").click(function(){
        var brand_name = trim($("#update-brandName").val());
        var brand_id = $("#update-brandId").val();
        var token = $("#token-bulksms").val();
        $("#update-ajax-error").html("");
        $.ajax({
            type: "POST",
            url: '/frontend.php/ajax/updateBrandName',
            data:{
                brand_name: brand_name,
                brand_id: brand_id,
                token: token
            },
            cache: false,
            success: function (result) {
                var data = JSON.parse(result);
                var status = data.status;
                checkStatus(status);
                if(status == -2){
                    window.location.href = "dang-nhap";
                }else if(status == 1){
                    $('#updateBrandNameModal').modal("hide");
                    $("#brand-name-" + brand_id).text(brand_name);
                    $("#brand-status-" + brand_id).text('Chờ duyệt');
                }else{
                    $("#update-ajax-error").html(data.notice);
                }
            }
        });
    });

    //trungpd2: Hiển thị popup cập nhật thông tin khách hàng
    $(document ).on( "click",".update-contact", function() {
        var ids = $(this).attr('id'); //group_id - contact_id
        var token = $("#token-bulksms").val();
        $("#update-contact-error").html("");
        $.ajax({
            type: 'GET',
            url: '/frontend_dev.php/ajax/getContactInfo',
            data:{
                ids: ids,
                token: token
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                if(returnResult.status == 1){
                    $('#show-update-contact').modal('show');
                    $('#update-contact-name').val(returnResult.name);
                    $('#update-contact-phone').val(returnResult.phone);
                    document.getElementById('update-contact-phone')
                        .setAttribute("value", returnResult.group_id + "-" + returnResult.contact_id);
                } else if(returnResult.status == -2){
                    location.reload();
                } else{
                    alert(returnResult.description);
                }
            }
        })
    });

    //trungpd2: Cập nhật thông tin khách hàng
    $("#btn-update-contact-popup").click(function(){
        var name = trim($("#update-contact-name").val());
        var phone = trim($("#update-contact-phone").val());
        var token = $("#token-bulksms").val();
        //$ids[0] -> group_id,  $ids[1] -> contact_id
        var ids = document.getElementById('update-contact-phone').getAttribute('value').split('-');
        $.ajax({
            type: 'POST',
            url: '/frontend.php/ajax/submitUpdateContact',
            data:{
                name: name,
                phone: phone,
                group_id: ids[0],
                contact_id: ids[1],
                token: token
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                if(returnResult.status ==1){
                    $('#show-update-contact').modal('hide');
                    $("#tbody-contact-group tr #contact-name-" + ids[1]).text(returnResult.name);
                    $("#tbody-contact-group tr #contact-name-" + ids[1])['0'].setAttribute("title", returnResult.name);
                    $("#tbody-contact-group tr #contact-phone-" + ids[1]).text(returnResult.phone);
                } else if (returnResult.status == -2){
                    location.reload();
                } else if(returnResult.status == -1){
                    alert(returnResult.notice);
                }
                else{
                    $("#update-contact-error").html(returnResult.notice);
                }
            }
        })
    });

    $("#add-group-popup").click(function() {
        var groupName = trim($("#groupName").val());
        var groupNote = trim($("#groupNote").val());
        var token = $("#token-bulksms").val();
        $.ajax({
            type:"POST",
            url:"/frontend.php/ajax/submitAddGroup",
            data:{
                groupName: groupName,
                groupNote:groupNote,
                token:token
            },
            cache:false,
            success:function (result) {
                var returnResult = JSON.parse(result);
                checkStatus(returnResult.status);
                if(returnResult.status ==-4){
                    window.location.href = "dang-nhap";
                }else if(returnResult.status !=1){
                    $("#groupName-err").html(returnResult.notice);
                } else {
                    $("#list-bulk-group").prepend('<tr id="delete-item-' + returnResult.group_id+ '">' +
                                '<td class="vtt-center"><input type="checkbox" name="check[]" value="'+ returnResult.group_id + '"></td>'+
                                '<td class="vtt-center" id="group-name-'+ returnResult.group_id+'">' + htmlEntities(groupName) + '</td>' +
                                '<td class="vtt-center">0</td>' +
                                '<td>' +
                                    '<a href="javascript:void(0);" title="Sửa"><span class="glyphicon glyphicon-edit update-group-info" id="'+returnResult.group_id+ '"></span></a>' +
                                    '<a href="javascript:void(0);" title="Xóa"><span onclick="event.preventDefault();deleteGroup(' + returnResult.group_id +')" class="glyphicon glyphicon-remove"></span></a>' +
//                                    '<a href="javascript:void(0);" title="Xuất ra excel"><span class="glyphicon glyphicon-file"></span></a>' +
                                '</td>' +
                            '</tr>"');
                    $('#vt_bulksms_contact_upload_group_list').prepend('<option value="' + returnResult.group_id+ '">'+groupName +'</option>');
                    $('#vt_bulksms_contact_group_info').prepend('<option value="' + returnResult.group_id+ '">'+htmlEntities(groupName) +'</option>');
                    $('#filter-contact-group').append('<option value="' + returnResult.group_id+ '">'+htmlEntities(groupName) +'</option>');
                    $('#addCustomerGroupModal').modal("hide");
                }
            }
        })
    });
    $(document ).on( "click",".update-group-info", function() {
        var id_brand = $(this).attr('id');
        var token = $("#token-bulksms").val();
        $("#update-group-err").html("");
        $.ajax({
            type: 'get',
            url: '/frontend.php/ajax/getGroupInfo',
            data:{
                group_id: id_brand,
                token: token
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                status = returnResult.status;
                checkStatus(status);
                $('#updateCustomerGroupModal').modal('show');
                $('#update-groupName').val(returnResult.groupName);
                $('#update-groupNote').val(returnResult.groupNote);
                $('#update-groupId').val(returnResult.group_id);
            }
        })
    });

    $("#update-group-popup").click(function(){
        var group_id = $('#update-groupId').val();
        var groupNote = trim($('#update-groupNote').val());
        var groupName = trim($('#update-groupName').val());
        var token = $("#token-bulksms").val();
        $("#update-group-err").html("");
        $.ajax({
            type: 'post',
            url: '/frontend.php/ajax/submitUpdateGroup',
            data:{
                group_id: group_id,
                groupNote: groupNote,
                groupName: groupName,
                token: token
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                var status = returnResult.status
                checkStatus(status);
                if(status==1){
                    $('#updateCustomerGroupModal').modal("hide");
                    $("#group-name-" + group_id).text(groupName);
                    $('#vt_bulksms_contact_group_info option[value="' + group_id +'"]').text(groupName);
                    $('#vt_bulksms_contact_upload_group_list option[value="' + group_id +'"]').text(groupName);

                    $('#filter-contact-group option[value="' + group_id +'"]').text(groupName);
                    $("#tbody-contact-group tr #contact-group-name #" + group_id).text(groupName);
                    $("#btn-search-contact").trigger("click");
                }
                if(status != 1){
                    $("#update-group-err").html(returnResult.notice);
                }
            }
        })
    });

    $("#contactUpload").click(function(){
        $("#upload-error").html("");
    })

    $("#btn-delete-contact-popup").click(function(){
        var ids = $('#delete-contact-group :selected').attr('id').split('-');
        var contact_id = ids[0];
        var group_len = ids[1];
        var row = ids[2];
        var group_id = $('#delete-contact-group :selected').attr('value');
        var parent = $("#delete-contact-item-" + contact_id );
        var token = $("#token-bulksms").val();
        $.ajax({
            type: 'POST',
            url: '/frontend.php/ajax/submitDeleteContactGroup',
            data:{
                group_id: group_id,
                contact_id: contact_id,
                token: token
            },
            beforeSend: function() {
                if(group_len == 1){
                    parent.animate({'backgroundColor':'#fb6c6c'}, 250);
                }
            },
            success: function(result) {
                var returnResult = JSON.parse(result);
                checkStatus(returnResult.status);
                if (returnResult.status == 1){
                    if(group_len == 1){
                        parent.hide('fast');
//                        var object = document.getElementById('num-contact-group';
//                        var value = object.getAttribute('value');
//                        value = value > 0 ? value - 1 : value;
//                        object.setAttribute("value", value);
//                        object.innerHTML = 'Tổng số KH: ' + value;

                    }else{
                        $("#tbody-contact-group tr #contact-group-name")[row].innerHTML = returnResult.name;
                    }
                    if( document.getElementById('num-contact-group') && document.getElementById('num-contact-group').getAttribute('value') <= 0){
                        var ZObject = document.getElementById('zero-contact-group');
                        ZObject.setAttribute("style", "visibility: visible");
                    }
                    $('#delete-contact-group option[value="' + group_id +'"]').remove();

                    var num = $('#list-bulk-group tr #group-num-' + group_id).text();
                    $('#list-bulk-group tr #group-num-' + group_id).text(num > 0 ? num - 1 : 0);

//                    $("#show-delete-contact").modal('hide');
                }else{
                    $("#delete-contact-error").html(returnResult.notice);
                    parent.animate({'backgroundColor':'WHITE'}, 0);
                }
            },
            error: function(message){
                $("#show-delete-contact").modal('hide');
                parent.animate({'backgroundColor':'WHITE'}, 0);
            }
        });
        //giand9 loại bỏ các item khi rời khác hàng khỏi nhóm
        if($('#delete-contact-group').children('option').length == 1){
            $("#show-delete-contact").modal('hide');
        }else{
            $('#delete-contact-group option[value="' + group_id +'"]').remove();
        }
        var delay=1000; //1 seconds

        setTimeout(function(){
            $( "#btn-search-contact" ).trigger('click');
        }, delay);

        //end giangnd9
    });

    function checkStatus(status){
        switch (status) {
            case '-2':
                location.reload();
                break;
            case '-1':
                break;
            case '1':
                break;
        }
    }

    $("#btn-delete-contact-popup").click(function(){
        var brand_id = $(this).attr('id');
        $( "#btn-search-contact" ).click();
    });



});//end ready

    function deleteGroup(group_id){
        var parent = $("#delete-item-" + group_id);
        var group_name = $("#group-name-" + group_id).text();
        var token = $("#token-bulksms").val();
        if (confirm('Bạn có muốn xóa nhóm '+ group_name + ' không?')) {
            $.ajax({
                type: 'get',
                url: '/frontend.php/ajax/submitDeleteGroup',
                data:{
                    group_id: group_id,
                    token: token
                },
                beforeSend: function() {
                    parent.animate({'backgroundColor':'#fb6c6c'},  250);
                },
                success: function(result) {
                    var returnResult = JSON.parse(result);

                    if (returnResult.status ==1 && returnResult.is_base !=1){
                        parent.hide('fast');
                        $('#vt_bulksms_contact_group_info option[value="' + group_id +'"]').remove();
                        $('#vt_bulksms_contact_upload_group_list option[value="' + group_id +'"]').remove();
                        $('#filter-contact-group option[value="' + group_id +'"]').remove();
                        $('#btn-search-contact').click();
                    } else if(returnResult.is_base ==1){
                        $('#group-num-' + group_id).text(0);
                        parent.css("background", "");
                    } else{
                        location.reload();
                    }
                }
            });
        }
    };


    /**
     *
     * @param group_id
     * @param contact_id
     * @author: trungpd2
     */
    function deleteContactGroup(contact_id, row){
        var token = $("#token-bulksms").val();
        $("#delete-contact-error").html("");
        $.ajax({
            type: 'GET',
            url: '/frontend.php/ajax/getContactById',
            data:{
                contact_id: contact_id,
                token: token
            },
            success: function(result) {
                var foo = JSON.parse(result);
                if(foo.status == 1){
                    $("#delete-contact-name").val(foo.contact[0].name);
                    $("#delete-contact-phone").val(foo.contact[0].phone);
                    $('#delete-contact-group option').remove();
                    var len = foo.contact[0].VtBulksmsGroupInfo.length;
                    $.each(foo.contact[0].VtBulksmsGroupInfo, function(){
                        $('#delete-contact-group').append('<option id = "' + foo.contact[0].id + '-' + len + '-' + row
                            + '" value="' + this.id+ '">'+ htmlEntities(this.group_name) +'</option>');
                    });
                    $("#show-delete-contact").modal('show');
                }else if(foo.status == -2){
                    location.reload();
                } else {
                    alert(foo.notice);
                    location.reload();

                }
            }
        });
    };

    /**
     * xử lý xuất danh bạ ra excel theo từng nhóm đã chọn
     *
     * @param group_id
     */
    function exportGroupContactToExcel(group_id){
        var token = $("#token-bulksms").val();
        $.ajax({
            type: 'POST',
            url: '/frontend.php/ajax/exportContactByGroupToExcel',
            data:{
                group_id: group_id,
                token: token
            },
            success: function(result) {
                console.log(result);
                alert(result);
                //alert('Xuất danh bạ của nhóm ra Excel thành công!');
            }
        });


    }