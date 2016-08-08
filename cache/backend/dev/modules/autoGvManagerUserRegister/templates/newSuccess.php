<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gvManagerUserRegister/assets') ?>
<?php include_partial('gvManagerUserRegister/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('gvManagerUserRegister/new_sidebar', array('configuration' => $configuration)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('New GvManagerUserRegister', array(), 'messages') ?></h1>

            <?php include_partial('gvManagerUserRegister/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('gvManagerUserRegister/form_header', array('user' => $user, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('gvManagerUserRegister/form', array('user' => $user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('gvManagerUserRegister/form_footer', array('user' => $user, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('gvManagerUserRegister/footer') ?>