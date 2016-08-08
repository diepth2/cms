<?php
  use_stylesheet('/vtAdvertisePlugin/css/jquery.multiselect.css');
  use_stylesheet('/vtAdvertisePlugin/css/jquery.multiselect.filter.css');
//  use_stylesheet('vtAdvertisePlugin/css/jquery-ui.css');
//  use_javascript('/vtAdvertisePlugin/js/jquery-ui.min.js');
  use_javascript('/vtAdvertisePlugin/js/jquery.multiselect.js');
  use_javascript('/vtAdvertisePlugin/js/jquery.multiselect.filter.js');
?>

<style type="text/css">
    label input,
    label textarea,
    label select {
        display: inline !important;
        margin-right: 5px !important;
        margin-top: -2px !important;
    }
    #vt_advertise_location_list {
        width: 370px !important;
        height: 40px !important;
    }
</style>

<?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
<?php endif; ?>
<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
    <?php foreach ($fields as $name => $field): ?>
        <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        <?php include_partial('vtAdvertiseAdmin/form_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
            'vt_advertise' => $vt_advertise        )) ?>
    <?php endforeach; ?>
    <script type="text/javascript">
        $("#vt_advertise_location_list").multiselect().multiselectfilter();
    </script>
</fieldset>

