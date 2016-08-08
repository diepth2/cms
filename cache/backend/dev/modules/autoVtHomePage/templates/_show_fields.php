    <table class="table table-bordered table-striped table-show" id="show_vtHomePage">
        <tbody>
                                    <tr>
                <th><?php echo __('Id', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_id">
<?php echo link_to( VtHelper::truncate($sf_guard_user->getId(), 50, '...', true) , 'homepage_edit', $sf_guard_user) ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('First name', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_first_name">
<?php echo  VtHelper::truncate($sf_guard_user->getFirstName(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Last name', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_last_name">
<?php echo  VtHelper::truncate($sf_guard_user->getLastName(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Phone', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_phone">
<?php echo  VtHelper::truncate($sf_guard_user->getPhone(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Email address', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_email_address">
<?php echo  VtHelper::truncate($sf_guard_user->getEmailAddress(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Username', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_username">
<?php echo  VtHelper::truncate($sf_guard_user->getUsername(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Algorithm', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_algorithm">
<?php echo  VtHelper::truncate($sf_guard_user->getAlgorithm(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Salt', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_salt">
<?php echo  VtHelper::truncate($sf_guard_user->getSalt(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Password', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_password">
<?php echo  VtHelper::truncate($sf_guard_user->getPassword(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Is active', array(), 'messages') ?></th>
            <td class="sf_admin_boolean sf_admin_list_th_is_active">
<?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsActive(), 50, '...', true) )) ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Is super admin', array(), 'messages') ?></th>
            <td class="sf_admin_boolean sf_admin_list_th_is_super_admin">
<?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsSuperAdmin(), 50, '...', true) )) ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Last login', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_last_login">
<?php echo  VtHelper::truncate($sf_guard_user->getLastLogin(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Pass update at', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_pass_update_at">
<?php echo  VtHelper::truncate($sf_guard_user->getPassUpdateAt(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Is lock signin', array(), 'messages') ?></th>
            <td class="sf_admin_boolean sf_admin_list_th_is_lock_signin">
<?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsLockSignin(), 50, '...', true) )) ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Locked time', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_locked_time">
<?php echo  VtHelper::truncate($sf_guard_user->getLockedTime(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Created at', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_created_at">
<?php echo  VtHelper::truncate($sf_guard_user->getCreatedAt(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Updated at', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_updated_at">
<?php echo  VtHelper::truncate($sf_guard_user->getUpdatedAt(), 50, '...', true)  ?>
</td>                </tr>
                        </tbody>
    </table>
