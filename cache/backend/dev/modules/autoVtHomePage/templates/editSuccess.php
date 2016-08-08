<?php use_helper('I18N', 'Date') ?>
<?php include_partial('vtHomePage/assets') ?>
<?php include_partial('vtHomePage/header') ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if ($sidebar_status): ?>
            <?php include_partial('vtHomePage/edit_sidebar', array('configuration' => $configuration, 'sf_guard_user' => $sf_guard_user)) ?>
        <?php endif; ?>

        <div class="span<?php echo $sidebar_status ? '10' : '12'; ?>">
            <h1><?php echo __('Edit VtHomePage', array(), 'messages') ?></h1>

            <?php include_partial('vtHomePage/flashes') ?>

            <div id="sf_admin_header">
                <?php include_partial('vtHomePage/form_header', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>

            <div id="sf_admin_content">
                <?php include_partial('vtHomePage/form', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>

                <?php if (in_array('version', $fields->getRawValue())): ?>
                    <?php include_partial('versions', array('sf_guard_user' => $sf_guard_user->getRawValue(), 'fields' => $fields)); ?>
                <?php endif; ?>
            </div>

            <div id="sf_admin_footer">
                <?php include_partial('vtHomePage/form_footer', array('sf_guard_user' => $sf_guard_user, 'form' => $form, 'configuration' => $configuration)) ?>
            </div>
        </div>
    </div>
</div>

<?php include_partial('vtHomePage/footer') ?>