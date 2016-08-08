    <table class="table table-bordered table-striped table-show" id="show_gvManagerUserRegister">
        <tbody>
                                    <tr>
                <th><?php echo __('Userid', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_userid">
<?php echo link_to( VtHelper::truncate($user->getUserid(), 50, '...', true) , 'user_register_edit', $user) ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Username', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_username">
<?php echo  VtHelper::truncate($user->getUsername(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Password', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_password">
<?php echo  VtHelper::truncate($user->getPassword(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Displayname', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_displayname">
<?php echo  VtHelper::truncate($user->getDisplayname(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Identity', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_identity">
<?php echo  VtHelper::truncate($user->getIdentity(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Address', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_address">
<?php echo  VtHelper::truncate($user->getAddress(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Email', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_email">
<?php echo  VtHelper::truncate($user->getEmail(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Mobile', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_mobile">
<?php echo  VtHelper::truncate($user->getMobile(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Birthday', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_birthday">
<?php echo  VtHelper::truncate($user->getBirthday(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Sex', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_sex">
<?php echo  VtHelper::truncate($user->getSex(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Registedtime', array(), 'messages') ?></th>
            <td class="sf_admin_date sf_admin_list_th_registedtime">
<?php echo  VtHelper::truncate($user->getRegistedtime(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Age', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_age">
<?php echo  VtHelper::truncate($user->getAge(), 50, '...', true)  ?>
</td>                </tr>
                                                <tr>
                <th><?php echo __('Status', array(), 'messages') ?></th>
            <td class="sf_admin_text sf_admin_list_th_status">
<?php echo  VtHelper::truncate($user->getStatus(), 50, '...', true)  ?>
</td>                </tr>
                        </tbody>
    </table>
