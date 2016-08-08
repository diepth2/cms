/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 8/30/13
 * Time: 4:30 PM
 * To change this template use File | Settings | File Templates.
 */

(function ($) {
    $(document).ready(function () {
        $('.tree li').each(function () {
            if ($(this).children('ul').length > 0) {
                $(this).addClass('parent');
            }
        });

        $('.tree li.parent em').each(function () {
            $(this).click(function () {

                // dong tat ca cac cau hoi dang mo
                $('.tree li.parent em').removeClass('action');
                $('.tree li.parent em').parent().children('ul').hide('slow');

                if ($(this).hasClass('action')) {
                    $(this).removeClass('action');
                } else {
                    $(this).addClass('action');
                }
                // hien thi cau hoi duoc chon
                $(this).parent().children('ul').slideToggle('fast');
            });
        });

        $('.tree li.parent em').click(function () {
//            $(this).parent().children('ul').slideToggle('fast');
        });

    })
})(jQuery);