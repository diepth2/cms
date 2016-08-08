/**
 * Created by DucAnh on 21/04/2014.
 */

jQuery('.tabs li a').click(function () {
    var $li = $(this).parent();
    var $ul = $li.parent();
    $ul.find('.active').removeClass('active');
    $li.addClass('active');

    var href = $(this).attr('href');
    var $tabs = $ul.closest('.tabs');
    $tabs.find('.tab-items > div').hide();
    $tabs.find(href).show();

    return false;
});