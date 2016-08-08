jQuery(document).ready(function ($) {
    var modalPopupTemplate = '<div class="isoftz-ui-dialog" tabindex="-1" style="outline: none; display: none;"></div>';
    window.isoftzModal = {
        create: function (selector, width) {
            //            var $modal = $(selector).dialog({
            //                modal: true,
            //                autoOpen: false,
            //                dialogClass: 'isoftz-popup',
            //                position: "center",
            //                minWidth: width,
            //                maxWidth: 1600,
            //                maxHeight: 1080,
            //                resizable: false,
            //                closeOnEscape: true,
            //                refresh: refresh,
            //                close: function( event, ui ) {
            //                    isoftzModal.closePopUp();
            //                }
            //            });
            //
            //            $modal.removeClass('ui-dialog-content ui-widget-content');
            //            var $parent = $modal.parent();
            //            $parent.addClass('isoftz-popup')
            //                .removeClass('ui-dialog ui-widget ui-widget-content ui-corner-all')
            //                .find('.ui-dialog-titlebar, .ui-widget-header')
            //                .remove();

            var $modal = $(modalPopupTemplate);
            var $selector = $(selector);
            $selector.width(width);
            $selector.addClass('isoftz-popup-box');
            $modal.append($selector);

            $('body').append($modal);

            return $modal;
        },
        createAutoSize: function (selector, width) {
            // This method use to message popup
            var $modal = isoftzModal.create(selector, width);
            $modal.addClass('auto-size');
        },
        load: function () {

        },
        show: function (selector) {
            var $modal = $(selector);
            var $popup = $modal.parent();

            var maxZIndex = 5000;
            $('.isoftz-ui-dialog:visible, .isoftz-ui-overlay:visible').each(function () {
                var zIndex = $(this).css('zIndex');
                if (zIndex > maxZIndex) {
                    maxZIndex = zIndex;
                }
            });

            $popup.css('zIndex', maxZIndex + 2);
            $modal.show();
            $popup.show();

            if ($popup.hasClass('auto-size')) {
                $popup.css('top', (document.documentElement.clientHeight - $modal.height()) / 2);
                $popup.css('left', (document.documentElement.clientWidth - $modal.width()) / 2);
            }

            var $overlay = $popup.next();
            if (!$overlay.hasClass('isoftz-ui-overlay')) {
                $overlay = $('<div class="isoftz-ui-overlay"></div>');
                $popup.after($overlay);
            }

            $overlay.css('zIndex', maxZIndex + 1);

            return $modal;
        },
        closePopUp: function (selector) {
            var $popup = $(selector).parent();
            if ($popup.hasClass('isoftz-ui-dialog')) {
                $popup.hide();
                $popup.next().remove();
            }
        },
        refreshPopup: function () {

        }
    };

    //$(window).resize(function () {
    //    // console.log('Window is resize.');
    //    // $("#dialog").dialog("option", "position", "center");
    //    $(".isoftz-ui-dialog.auto-size:visible").each(function () {
    //        var $popup = $(this);
    //        var $popupBox = $popup.children().eq(0);

    //        $popup.css('top', (document.documentElement.clientHeight - $popupBox.height()) / 2);
    //        $popup.css('left', (document.documentElement.clientWidth - $popupBox.width()) / 2);
    //    });
    //});
});