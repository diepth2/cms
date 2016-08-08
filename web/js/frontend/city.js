
$(function(){
    $('#home-province').change(function () {
        var select = this.options[this.selectedIndex].value;
        $("#home-guild Option").each(function () {
            $(this).remove();
        });
        $('#home-guild').append($('<option>', {
            value:'',
            text:phuong_xa
        }));
        $("#home-district Option").each(function () {
            $(this).remove();
        });
        $('#home-district').append($('<option>', {
            value:'',
            text:quan_huyen
        }));
        if (select> 0){
            $.ajax({
                url: urlService,
                type: 'GET',
                dataType: 'json',
                data: {'selectCity': select, token: $("#ajax_token").val()},
                complete: function(arrAction){
                    var arrAction = $.parseJSON(arrAction.responseText);
                    $.each(arrAction, function (key, value) {
                        key = key.substring(1, key.length);

                        $('#home-district').append($('<option>', {
                            value:'' + key + '',
                            text:value
                        }));
                    })
                }
            });
        }
    });

    $('#home-district').change(function () {
        var select = this.options[this.selectedIndex].value;
        $("#home-guild Option").each(function () {
            $(this).remove();
        });
        $('#home-guild').append($('<option>', {
            value:'',
            text:phuong_xa
        }));
        if (select> 0){
            $.ajax({
                url: urlService,
                type: 'GET',
                dataType: 'json',
                data: {'selectCity': select, token: $("#ajax_token").val()},
                complete: function(arrAction){
                    var arrAction = $.parseJSON(arrAction.responseText);
                    $("#home-guild Option").each(function () {
                        $(this).remove();
                    });
                    $('#home-guild').append($('<option>', {
                        value:'',
                        text:phuong_xa
                    }));
                    $.each(arrAction, function (key, value) {
                        key = key.substring(1, key.length);

                        $('#home-guild').append($('<option>', {
                            value:'' + key + '',
                            text: value
                        }));
                    })
                }
            });
        }
    });
});
$(".datepicker").datepicker({ dateFormat: 'dd-mm-yy' });