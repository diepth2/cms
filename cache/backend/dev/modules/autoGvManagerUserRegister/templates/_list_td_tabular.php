  
  <td class="sf_admin_text sf_admin_list_td_parter_name" field="parter_name"><?php echo  VtHelper::truncate($user->getParterName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_os_build" field="os_build"><?php echo  VtHelper::truncate($user->getOsBuild(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_imei" field="imei"><?php echo  VtHelper::truncate($user->getImei(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_userid" field="userid"><?php echo link_to( VtHelper::truncate($user->getUserid(), 50, '...', true) , 'user_register_edit', $user) ?></td>      
  <td class="sf_admin_text sf_admin_list_td_username" field="username"><?php echo  VtHelper::truncate($user->getUsername(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_display_name" field="display_name"><?php echo  VtHelper::truncate($user->getDisplayName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_date sf_admin_list_td_registedtime" field="registedtime"><?php echo  VtHelper::truncate($user->getRegistedtime(), 50, '...', true)  ?></td>    