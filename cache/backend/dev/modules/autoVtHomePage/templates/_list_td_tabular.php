  
  <td class="sf_admin_text sf_admin_list_td_id" field="id"><?php echo link_to( VtHelper::truncate($sf_guard_user->getId(), 50, '...', true) , 'homepage_edit', $sf_guard_user) ?></td>      
  <td class="sf_admin_text sf_admin_list_td_first_name" field="first_name"><?php echo  VtHelper::truncate($sf_guard_user->getFirstName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_last_name" field="last_name"><?php echo  VtHelper::truncate($sf_guard_user->getLastName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_phone" field="phone"><?php echo  VtHelper::truncate($sf_guard_user->getPhone(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_email_address" field="email_address"><?php echo  VtHelper::truncate($sf_guard_user->getEmailAddress(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_username" field="username"><?php echo  VtHelper::truncate($sf_guard_user->getUsername(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_algorithm" field="algorithm"><?php echo  VtHelper::truncate($sf_guard_user->getAlgorithm(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_salt" field="salt"><?php echo  VtHelper::truncate($sf_guard_user->getSalt(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_password" field="password"><?php echo  VtHelper::truncate($sf_guard_user->getPassword(), 50, '...', true)  ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_active" field="is_active"><?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsActive(), 50, '...', true) )) ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_super_admin" field="is_super_admin"><?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsSuperAdmin(), 50, '...', true) )) ?></td>      
  <td class="sf_admin_date sf_admin_list_td_last_login" field="last_login"><?php echo  VtHelper::truncate($sf_guard_user->getLastLogin(), 50, '...', true)  ?></td>      
  <td class="sf_admin_date sf_admin_list_td_pass_update_at" field="pass_update_at"><?php echo  VtHelper::truncate($sf_guard_user->getPassUpdateAt(), 50, '...', true)  ?></td>      
  <td class="sf_admin_boolean sf_admin_list_td_is_lock_signin" field="is_lock_signin"><?php echo get_partial('vtHomePage/list_field_boolean', array('value' =>  VtHelper::truncate($sf_guard_user->getIsLockSignin(), 50, '...', true) )) ?></td>      
  <td class="sf_admin_text sf_admin_list_td_locked_time" field="locked_time"><?php echo  VtHelper::truncate($sf_guard_user->getLockedTime(), 50, '...', true)  ?></td>      
  <td class="sf_admin_date sf_admin_list_td_created_at" field="created_at"><?php echo  VtHelper::truncate($sf_guard_user->getCreatedAt(), 50, '...', true)  ?></td>      
  <td class="sf_admin_date sf_admin_list_td_updated_at" field="updated_at"><?php echo  VtHelper::truncate($sf_guard_user->getUpdatedAt(), 50, '...', true)  ?></td>    