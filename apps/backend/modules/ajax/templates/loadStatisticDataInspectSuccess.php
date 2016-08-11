<?php
$form = new BaseForm();
if ($form->isCSRFProtected()):?>
    <input type="hidden" id="ajax_token" value="<?php echo $form->getCSRFToken() ?>" />
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function () {
        changePagination('0');
    });
    function changePagination(pageId) {
        var filter_date = $("#filter-date").val();
        var filter_type = $("#filter-type").val();
        var filter_game = $("#filter-game").val();
        var filter_os = $("#filter-os").val();
        var date_from = $("#date-from").val();
        var date_to = $("#date-to").val();
        var url = '<?php echo url_for('ajax_load_statistic_data_inspect_pagination') ?>';
        var csrf_value = $("#ajax_token").val();
        $.ajax({
            type: "POST",
            url: url,
            data:
            {
                pageId: pageId,
                filter_date: filter_date,
                filter_type: filter_type,
                filter_game: filter_game,
                date_from: date_from,
                filter_os: filter_os,
                date_to: date_to,
                token: csrf_value
            },
            cache: false,
            success: function (result) {
                $("#statisticdiv").html(result);
            }
        });
    }
</script>

