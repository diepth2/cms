<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 6/12/14
 * Time: 3:09 PM
 * To change this template use File | Settings | File Templates.
 */
class WsNoBccsGw
{
    public static function checkPassADSLVTP($account, $password, $type)
    {
        $yamlFile = sfConfig::get('sf_app_dir') . '/config/wsdl.yml';
        $arrData = sfYaml::load($yamlFile);
        $wsdl = $arrData['vtp']['adsl'];

        $connectTimeout = $arrData['timeout']['connect'];
        $responseTimeout = $arrData['timeout']['response'];

        $arguments = array(
            'appCode' => $arrData['vtp']['adsl_user'],
            'appPassword' => $arrData['vtp']['adsl_pass'],
            'account' => $account,
            'pass' => $password,
            'type' => $type
        );

        try {
            $client = new VtpSoapClient($wsdl, array('trace' => true, 'connect_timeout' => $connectTimeout, 'timeout' => $responseTimeout));
            $result = $client->__soapCall('checkPass', array($arguments));
            //$code = $result->return;
            $code = $result->checkPassReturn;
            if($code==0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('{VTP} checkPassAdsl --> error xxxxxxxxxx Lỗi hệ thống: ' . $e->getMessage());
            return false;
        }
    }
}