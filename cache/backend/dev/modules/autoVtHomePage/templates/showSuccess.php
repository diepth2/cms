<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vtHomePage/assets') ?>
<?php include_partial('vtHomePage/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('vtHomePage/show_sidebar', array('configuration' => $configuration, 'sf_guard_user' => $sf_guard_user)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">

            <h1><?php echo __('Show VtHomePage', array(), 'messages') ?></h1>

            <?php include_partial('vtHomePage/flashes') ?>

            <?php include_partial('show_fields', array('configuration' => $configuration, 'sf_guard_user' => $sf_guard_user)); ?>

            <?php if (in_array('version', $fields->getRawValue())): ?>
                <?php include_partial('versions', array('sf_guard_user' => $sf_guard_user->getRawValue(), 'fields' => $fields)); ?>
            <?php endif; ?>

            <div class="btn-group">
                                                            <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>                                                                                <?php echo $helper->linkToEdit($sf_guard_user, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>                                                                                <?php echo $helper->linkToDelete($sf_guard_user, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                                </div>
        </div>
    </div>
</div>
<br />
<?php include_partial('vtHomePage/footer') ?>