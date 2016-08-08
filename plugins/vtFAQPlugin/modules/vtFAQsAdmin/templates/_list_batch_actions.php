<div class="well pull-left margin-right">
    <div class="btn-group">
        <button type="submit" class="btn btn-success" name="batch_action" value="batchDelete"
                id="batchDelete"><?php echo __('Delete', array(), 'messages') ?></button>
        <button type="submit" class="btn btn-success" name="batch_action" value="batchActive"
                id="batchActive"><?php echo __('Active', array(), 'messages') ?></button>
        <button type="submit" class="btn btn-success" name="batch_action" value="batchDeactive"
                id="batchDeactive"><?php echo __('Deactive', array(), 'messages') ?></button>
    </div>
  <?php $form = new BaseForm(); if ($form->isCSRFProtected()): ?>
    <input type="hidden" name="<?php echo $form->getCSRFFieldName() ?>" value="<?php echo $form->getCSRFToken() ?>"/>
  <?php endif; ?>
</div>
<?php
$message = __('Bạn có chắc muốn xóa không?');
$messagedeactive = __('Bạn có chắc muốn hủy kích hoạt không?')
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('form#list-form').submit(function (e) {
            if (e.originalEvent.explicitOriginalTarget.id == "batchDelete") {
                var ok = confirm('<?php echo $message ?>');
                if (ok) {
                    return true;
                }
                else {
                    e.preventDefault();
                    return false;
                }
            }
        });

        $('form#list-form').submit(function (e) {
            if (e.originalEvent.explicitOriginalTarget.id == "batchDeactive") {
                var ok = confirm('<?php echo $messagedeactive ?>');
                if (ok) {
                    return true;
                }
                else {
                    e.preventDefault();
                    return false;
                }
            }
        });
        return;
    });
</script>
