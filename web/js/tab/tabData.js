$(function () {
    $("#tabs").tabs();

    var idTab = "#tabs-1";
// luc chon cac phan tu tiep theo
    $('.tab_li').find('li a').each(function () {
        $(this).click(function () {
            idTab = $(this).attr('href');
            $(idTab).find('thead td').each(function () {
                $(this).click(function () {
                    $(idTab).find('td.dt_active').each(function () {
                        $(this).removeClass('dt_active');
                        var idHide = $(this).attr('id');
                        $('#tr_' + idHide).hide('slow');
                    });
                    var idShow = $(this).attr('id');
                    $(this).addClass('dt_active');
                    $('#tr_' + idShow).show('slow');

                })
            });
        })
    });

// lua chon phan tu dau tien
    $(idTab).find('thead td').each(function () {
        $(this).click(function () {
            $(idTab).find('td.dt_active').each(function () {
                $(this).removeClass('dt_active');
                var idHide = $(this).attr('id');
                $('#tr_' + idHide).hide('slow');
            });
            var idShow = $(this).attr('id');
            $(this).addClass('dt_active');
            $('#tr_' + idShow).show('slow');

        })
    });

});