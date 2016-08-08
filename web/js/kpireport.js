(function ($) {
    $(document).ready(function () {


        $('body').on('click.modal.data-api', '[data-toggle="loginHome"]', function ( e ) {
            var $this = $(this), href
                , $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
                , option = $target.data('modal') ? 'toggle' : $.extend({}, $target.data(), $this.data())

            e.preventDefault()
            $target.modal(option)
        })



        $('input.sf_admin_batch_checkbox').click(function(){

            var numberOfChecked = $('input:checkbox:checked').length;
            var totalCheckboxes = $('input:checkbox').length;

            if(numberOfChecked==totalCheckboxes-2){
                $('input.sf_admin_list_batch_checkbox').attr('checked',true);
            }else{
                $('input.sf_admin_list_batch_checkbox').attr('checked',false);
            }

//            alert($(this).val());
        });


        $('#ui-datepicker-div').hide();
        $('#fromday').datepicker({
            showButtonPanel:true,
            altFormat:"yy-mm-dd"
        });
        $('#today').datepicker({
            showButtonPanel:true,
            altFormat:"yy-mm-dd"
        });

        $('#vtp_smart_promotion_award_admin_form_datetime_active').datepicker({
            showButtonPanel:true,
            altFormat:"yy-mm-dd"
        });

    });

})(jQuery);

function cleardatepic(val) {
    $(document).ready(function () {
        $(val + '1').val('');
    });
}