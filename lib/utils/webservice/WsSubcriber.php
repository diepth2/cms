<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ngoctv1
 * Date: 6/9/14
 * Time: 2:09 PM
 * To change this template use File | Settings | File Templates.
 */
class WsSubcriber
{
    private $errorMessage;
    private $client;
    private $bccsUsername;
    private $bccsPassword;

    public function __construct()
    {
        $yamlFile = sfConfig::get('sf_app_dir') . '/config/bccs.yml';
        $arrData = sfYaml::load($yamlFile);
        $wsdl = $arrData['bccs']['url'];
        $connectTimeout = $arrData['timeout']['connect'];
        $responseTimeout = $arrData['timeout']['response'];

        $this->bccsUsername = $arrData['bccs']['username'];
        $this->bccsPassword = $arrData['bccs']['password'];

        try {
            $this->client = new VtpSoapClient($wsdl, array('connect_timeout' => $connectTimeout, 'timeout' => $responseTimeout));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            sfContext::getInstance()->getLogger()->log('[WsSubcriber] __construct exceltion, msg=' . $msg);
            $this->errorMessage = 'Operation not successful, please manipulation behind. Thank you! ';
            return false;
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getSubInfo($msisdn)
    {
        $client = new VtpGetSubInfoMob();
        return $client->getSubInfo1($msisdn);

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getSubInfo',
            'param' => array(
                array('name' => 'msisdn', 'value' => $msisdn),
            )
        );
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getSubInfo Begin, arrs=', sfLogger::ERR);
        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getSubInfo exception, msg= ' . $e->getMessage(), sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getSubInfo result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<getSubInfoReturn>", "</getSubInfoReturn>");
            if ($value->resultCode == '0') {
                return $value->resultString;
            }
            return false;
        }
        return false;
    }

    public function getOTP($msisdn)
        //    public function getOTP($msisdn, $otp, $total, $datecreate)
    {
        // huync2: sua lai luong lay otp
        // gui OTP
        /*
        try {
            $strOtp = VtHelper::genRandomString(6);
            $msgOtp = 'Ma xac thuc cua quy khach la: ' . $strOtp . '. Quy khach vui long nhap ma nay de tiep tuc thuc hien cac thao tac su dung dich vu Tien ich truc tuyen cua Viettel Telecom Portal. Xin cam on!';
            $client = new sendSMSClient();
            $result = $client->sendSMS228($msisdn, $msgOtp);
            if ($result) {
                $otp->setMsisdn(VTPHelper::formatMobileNumber($msisdn, VTPHelper::MOBILE_849x));
                //                $otpString = MVPHelper::genRandomString(6);
                $otp->setOtp('');
                $date = date("Y-m-d H:i:s");
                $expTime = date('Y-m-d H:i:s', strtotime($date . ' + 1 day'));
                //$expTime = date('Y-m-d H:i:s', strtotime($date . ' + 30 minute'));
                $otp->setTimeExp($expTime);
                // chong spam
                $otp->setTotal($total);
                $otp->setDatecreated($datecreate);
                $otp->setOtpType(1);
                $otp->setOtp($strOtp);
                $otp->save();
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
        */

        // end huync2
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getOTP',
            'param' => array(
                array('name' => 'msisdn', 'value' => $msisdn),
            )
        );
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getOTP Begin, arrs='.json_encode($args) , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getOTP exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] getOTP result=' . json_encode($result), sfLogger::ERR);

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<getOTPReturn>", "</getOTPReturn>");
            return $value->resultCode;//0 - thanh cong
        }
        return false;
    }

    public function checkOTP($otp,$msisdn)
    {
        // huync2: kiem tra luong otp
        //        return VtOtpTable::getInstance()->checkOTP($msisdn, $otp);

        // end

        //        $objOtp = VtOtpTable::getInstance()->checkTotalOTP($msisdn, $otp);


        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'checkOTP',
            'param' => array(
                array('name' => 'otp', 'value' => $otp),
                array('name' => 'msisdn', 'value' => $msisdn),
            )
        );
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] checkOTP Begin, arrs=' , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] checkOTP exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] checkOTP result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<checkOTPReturn>", "</checkOTPReturn>");
            //            return $value->resultCode; //0 - OTP dung, cho phep thao tac
            if ($value->resultCode == '0') {
                return true;
            }
        }
        return false;
    }
}