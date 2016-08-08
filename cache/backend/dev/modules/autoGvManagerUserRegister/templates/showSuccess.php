<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gvManagerUserRegister/assets') ?>
<?php include_partial('gvManagerUserRegister/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('gvManagerUserRegister/show_sidebar', array('configuration' => $configuration, 'user' => $user)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">

            <h1><?php echo __('Show GvManagerUserRegister', array(), 'messages') ?></h1>

            <?php include_partial('gvManagerUserRegister/flashes') ?>

            <?php include_partial('show_fields', array('configuration' => $configuration, 'user' => $user)); ?>

            <?php if (in_array('version', $fields->getRawValue())): ?>
                <?php include_partial('versions', array('user' => $user->getRawValue(), 'fields' => $fields)); ?>
            <?php endif; ?>

            <div class="btn-group">
                                                            <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>                                                                                <?php echo $helper->linkToEdit($user, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>                                                                                <?php echo $helper->linkToDelete($user, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>                                                </div>
        </div>
    </div>
</div>
<br />
<?php include_partial('gvManagerUserRegister/footer') ?>