$(function () {
    //Chọn ngày cần thống kê doanh thu cho DEV
    $("#date-from").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        defaultDate: "+1w",
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: 0,
        onClose: function (selectedDate) {
            var dateMin = $(this).datepicker("getDate");
            if(dateMin != null){
                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate());
                $("#date-to").datepicker("option", "minDate", rMin);
            }
        }
    });

    //Chọn ngày cần thống kê doanh thu cho DEV
    $("#date-to").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        defaultDate: "+1w",
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: 0,
        onClose: function (selectedDate) {
            var dateMax = $(this).datepicker("getDate");
            if(dateMax != null){
                var rMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate());
                $("#date-from").datepicker("option", "maxDate", rMax);
            }
        }
    });

    // Datepicker khi dang ky, chon ngay sinh, CMND
    var yearRange = '1950:'+(new Date().getFullYear());
    $("#vt_publisher_info_register_birthday").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        dateFormat: 'dd/mm/yy',
        yearRange: yearRange,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: -3650
    });

    //Chọn ngày khi cập nhật thông tin ngày cấp CMND
    $("#vt_publisher_info_date_issue").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        dateFormat: 'dd/mm/yy',
        yearRange: yearRange,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: -0
    });

    //Chọn ngày khi cập nhật thông tin ngày sinh nhật
    $("#vt_publisher_info_birthday").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        dateFormat: 'dd/mm/yy',
        yearRange: yearRange,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: -3650
    });

    //Chọn ngày sinh nhật
    $("#vt_bulksms_contact_birthday").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        dateFormat: 'dd/mm/yy',
        yearRange: yearRange,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: -0
    });

    //Chọn ngày làm CMND
    $(".vt_date_issue").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        dateFormat: 'dd/mm/yy',
        yearRange: yearRange,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: -0
    });

    // Chọn ngày bắt đầu khi ký hợp đồng
    $("#vt_contract_start_date").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        defaultDate: "+1w",
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: 0,
        onClose: function (selectedDate) {
            var dateMin = $(this).datepicker("getDate");
            if(dateMin != null){
                var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate());
                $("#vt_contract_end_date").datepicker("option", "minDate", rMin);
            }
        }
    });

    // Chọn ngày kết thúc khi ký hợp đồng
    $("#vt_contract_end_date").datepicker({
        monthNamesShort: [ "Tháng một", "Tháng hai", "Tháng ba", "Tháng bốn", "Tháng năm", "Tháng sáu", "Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
        defaultDate: "+1w",
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        minDate: 0,
        onClose: function (selectedDate) {
            var dateMax = $(this).datepicker("getDate");
            if(dateMax != null){
                var rMax = new Date(dateMax.getFullYear(), dateMax.getMonth(), dateMax.getDate());
                $("#vt_contract_start_date").datepicker("option", "maxDate", rMax);
            }
        }
    });
});