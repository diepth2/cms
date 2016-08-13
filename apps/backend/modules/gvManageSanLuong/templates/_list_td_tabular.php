  
  <td class="sf_admin_text sf_admin_list_td_parter_name" field="parter_name"><?php echo  VtHelper::truncate($log_payment->getParterName(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_provider_code" field="provider_code"><?php echo  VtHelper::truncate($log_payment->getProviderCode(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_card_amount" field="card_amount"><?php echo  VtHelper::truncate($log_payment->getCardAmount(), 50, '...', true)  ?></td>      
  <td class="sf_admin_text sf_admin_list_td_menhgia" field="menhgia"><?php echo  VtHelper::truncate($log_payment->getMenhgia(), 50, '...', true)  ?></td>
  <td class="sf_admin_text sf_admin_list_td_sum" field="sum"><?php echo  VtHelper::truncate($log_payment->getMenhgia() * $log_payment->getCardAmount(), 50, '...', true)  ?></td>