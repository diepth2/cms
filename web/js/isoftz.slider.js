/*
 * Isoftz Team
 * Website: http://www.isoftz.com
 * Email: contact@isoftz.com
 */

jQuery.fn.ContentSlider = function (nextSelector, backSelector, itemDisplayCount) {
    var $ul = jQuery(this);
    var $lis = $ul.children('li');
    var $back, $next;
    $back = jQuery(backSelector);
    $next = jQuery(nextSelector);
    $back.addClass('inactive');
    if ($lis.length <= itemDisplayCount) {
        $next.addClass('inactive');
        return;
    }

    $next.addClass('active');
    var $firstItem = $lis.eq(0);
    var itemWidth = $firstItem.width();
    $lis.width(itemWidth);
    $ul.width(itemWidth * $lis.length);
    var firstItemIndex = 0;
    $back.click(function () {
        if ($back.hasClass('active')) {
            $next.removeClass('inactive').addClass('active');
            firstItemIndex--;
            $ul.animate({ 'left': $ul.position().left + itemWidth }, 'slow');

            if (firstItemIndex <= 0) {
                $back.removeClass('active').addClass('inactive');
            }
        }

        return false;
    });

    $next.click(function () {
        if ($next.hasClass('active')) {
            $back.removeClass('inactive').addClass('active');
            $ul.animate({ 'left': $ul.position().left - itemWidth }, 'slow');
            firstItemIndex++;
            if (firstItemIndex + itemDisplayCount >= $lis.length) {
                $next.removeClass('active').addClass('inactive');
            }
        }

        return false;
    });
};