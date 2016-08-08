<?php
/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 1/10/14
 * Time: 11:38 AM
 * To change this template use File | Settings | File Templates.
 */
class WsGetSubcriber
{
    private $errorMessage;
    private $client;
    private $bccsUsername;
    private $bccsPassword;

    private $subUsername;
    private $subPassword;

    private $cmUsername;
    private $cmPassword;

    public function __construct()
    {
        $yamlFile = sfConfig::get('sf_app_dir') . '/config/bccs.yml';
        $arrData = sfYaml::load($yamlFile);
        $wsdl = $arrData['bccs']['url'];

        $connectTimeout = $arrData['timeout']['connect'];
        $responseTimeout = $arrData['timeout']['response'];

        $this->bccsUsername = $arrData['bccs']['username'];
        $this->bccsPassword = $arrData['bccs']['password'];
        //thong tin user logon vao ws goc cc
        $this->subUsername = $arrData['subuser']['username'];
        $this->subPassword = $arrData['subuser']['password'];
        //thong tin user logon vao ws goc cm
        $this->cmUsername = $arrData['cmuser']['username'];
        $this->cmPassword = $arrData['cmuser']['password'];

        try {
            $this->client = new MVPSoapClient($wsdl, array('connect_timeout' => $connectTimeout, 'timeout' => $responseTimeout));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            sfContext::getInstance()->getLogger()->log('[WsChargePayment] __construct exceltion, msg=' . $msg);
            $this->errorMessage = 'Operation not successful, please manipulation behind. Thank you! ';
            return false;
        }
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /*
     * Webservice Service
    * lay thong tin tai khoan cua khach hang
    */
    public function viewAccInfo($isdn)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewAccInfo',
            'param' => array(
                array('name' => 'msisdn', 'value' => '51'.$isdn),
            )
        );
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] viewAccInfo Begin, arrs=' , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] viewAccInfo exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Service - Lay thong tin tai khoan] viewAccInfo result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            return $result;
//            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
//            if ($value->error == '0') {
//                return $value->lstAccInfo;
//            }
        }
        return false;
    }
    /*
     * Webservice Payment
     */
    //Tra cuoc tra sau
    public function countMBAllCall($isdn = '978186298', $fromDate = '01/12/2013', $endDate = '31/12/2013', $type = '1')
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'countMBAllCall',
            'param' => array(
                array('name' => 'isdn', 'value' => '51'.$isdn),
                array('name' => 'fromDate', 'value' => $fromDate),
                array('name' => 'toDate', 'value' => $endDate),
                array('name' => 'type', 'value' => $type),

            )
        );
        sfContext::getInstance()->getLogger()->log('[Payment-Tra cuoc tra sau] countMBAllCall Begin,  args=' , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Payment - Tra cuoc tra sau] countMBAllCall exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Payment - Tra cuoc tra sau] countMBAllCall result=' . json_encode($result), sfLogger::ERR);

        if ($result !== false) {

            if ($result->error == '0') {
                return $result->return;
            }
        }
        return false;
    }

    /*
     * -	call_in là chiều gọi đến
-	call_out là chiều gọi đi

    tra cuu tri tiet cuoc tra truoc lay chi tiet ban ghi tra ve
     */
    public function mbAllCall($isdn = '978186298', $fromDate = '01/12/2013', $endDate = '31/12/2013', $pageNum = 1, $pageSize = 10, $type = '1')
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'mbAllCall',
            'param' => array(
                array('name' => 'isdn', 'value' => '51'.$isdn),
                array('name' => 'fromDate', 'value' => $fromDate),
                array('name' => 'toDate', 'value' => $endDate),
                array('name' => 'pageNum', 'value' => $pageNum),
                array('name' => 'pageSize', 'value' => $pageSize),
                array('name' => 'type', 'value' => $type),
            )
        );
        sfContext::getInstance()->getLogger()->log('[Payment - Tra cuoc tra sau] mbAllCall Begin,  args=' , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }


        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[Payment - Tra cuoc tra sau] mbAllCall exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[Payment - Tra cuoc tra sau] mbAllCall result=' . json_encode($result), sfLogger::ERR);

        if ($result !== false) {
            if ($result->error == '0') {
                $value = MVPHelper::getOriginalBccsGW($result->original, '<ns2:mbAllCallResponse xmlns:ns2="http://services.payment.viettel.com/">', "</ns2:mbAllCallResponse>");
                return $value->return;
            }
        }
        return false;
    }

    /*
    * Webservice CC
    * tra chi tiet cuoc tra truoc
    * lay tong so ban ghi tra ve
    * <isdn>982054655</isdn>
           <fromDate>01/01/2012 00:00:00</fromDate>
           <endDate>01/01/2012 00:00:00</endDate>
           <callWay>CALL_IN</callWay>
    -	call_in là chiều gọi đến
-	call_out là chiều gọi đi
    00: ok
    value: tong ban ghi
    */

    public function countReportCallHis($isdn, $fromDate, $endDate, $callWay)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'countReportCallHis',
            'param' => array(
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'fromDate', 'value' => $fromDate),
                array('name' => 'endDate', 'value' => $endDate),
                array('name' => 'callWay', 'value' => $callWay),

                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );

        sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] countReportCallHis Begin, args=' , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] countReportCallHis exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] countReportCallHis result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if ($value->errorCode == '00') {
                return $value->value;
            }
        }
        return false;
    }

    /*
     * -	call_in là chiều gọi đến
-	call_out là chiều gọi đi

    tra cuu tri tiet cuoc tra truoc lay chi tiet ban ghi tra ve
     */
    public function getListCallHistory($isdn = '982054655', $fromDate = '01/01/2012 00:00:00', $endDate = '01/01/2012 00:00:00', $pageNum = 1, $pageSize = 10, $callWay = 'CALL_IN')
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListCallHistory',
            'param' => array(
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'fromDate', 'value' => $fromDate),
                array('name' => 'endDate', 'value' => $endDate),
                array('name' => 'pageNum', 'value' => $pageNum),
                array('name' => 'pageSize', 'value' => $pageSize),
                array('name' => 'callWay', 'value' => $callWay),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );

        sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] getListCallHistory Begin, args=' , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] getListCallHistory exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Tra cuoc tra truoc] getListCallHistory result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if ($value->errorCode == '00') {
                if (isset($value->listSubCallHistory)){
                    return $value->listSubCallHistory;
                }else return false;
            }
        }
        return false;
    }

    /*
     * lay cac dich vu
     */
    public function getListServiceType()
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListServiceType',
            'param' => array(
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );
        sfContext::getInstance()->getLogger()->log('[CC - Danh sach dich vu] getListServiceType Begin, args=' , sfLogger::ERR);
        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Danh sach dich vu] getListServiceType exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Danh sach dich vu] getListServiceType result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errorCode = $value->errorCode;
            if ($errorCode == '00') {
                return ($value->listServiceType);
            }
        }
        return false;
    }

    /*
     * lay cac nhom khieu nai
     * typeInsert=5 lấy ra Type trong INDECOPI
     */
    public function getListCompGroup($typeInsert)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListCompGroup',
            'param' => array(
                array('name' => 'typeInsert', 'value' => $typeInsert),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );

        sfContext::getInstance()->getLogger()->log('[CC - Danh sach nhom khieu nai] getListCompGroup Begin, args=' , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));

        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Danh sach nhom khieu nai] getListCompGroup exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Danh sach nhom khieu nai] getListCompGroup result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {

            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");

            if ($value->errorCode == '00') {
                if (isset($value->listCompGroup))

                return $value->listCompGroup;
            }
        }
        return false;
    }

    /*
     * lay cac loai khieu nai theo nhom
     */

    public function getListCompType($groupId)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListCompType',
            'param' => array(
                array('name' => 'groupId', 'value' => $groupId),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );
        sfContext::getInstance()->getLogger()->log('[CC - Loai khieu nai] getListCompType Begin,  args=' , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Loai khieu nai] getListCompType exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Loai khieu nai] getListCompType result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if ($value->errorCode == '00' && isset($value->listCompType)) {
                return $value->listCompType;
            }
        }
        return false;
    }

    /*
     * lay muc do uu tien
     */
    public function getListCompPriority()
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListCompPriority',
            'param' => array(
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );

        sfContext::getInstance()->getLogger()->log('[CC - Do uu tien] getListCompPriority Begin, args=' , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }


        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Do uu tien] getListCompPriority exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Do uu tien] getListCompPriority result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return $value->listPriority;
            }
        }
        return false;
    }


    /*
     * nhap khieu nai
     */
    public function createComplain(
      $typeInsert = '',
      $billFinishDate = '',
      $billNo = '',
      $billStartDate = '',
      $charge = '',
      $claimCode = '',
      $claimedLine = '',
      $compCauseId = '',
      $compContent = '',
      $compGroupId = '',
      $compTypeId = '',
      $complainId = '',
      $complainerAdress = '',
      $complainerIsOther = '',
      $complainerName = '',
      $complainerPassport = '',
      $complainerPhone = '',
      $complainerEmail='',
      $contractId = '',
      $contractNo,
      $custLimitDate,
      $depId = '',
      $fileAttatch = '',
      $fileAttatchName = '',
      $imsi = '',
      $latDatetimeUsing = '',
      $number = '',
      $placeError = '',
      $priorityId = '',
      $resultContent = '',
      $satisfiedLevel = '',
      $serial,
      $serviceType,
      $shopId = '',
      $subId = '',
      $userName = '',
      $acceptSourceId='',
      $districtCode='',
      $provinceCode=''
    )
    {
        $arrComplain = array(


        );
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'createComplain',
            'param' => array(
                array('name' => 'typeInsert', 'value' => $typeInsert),

                array('name' => 'billFinishDate', 'value' => $billFinishDate),
                array('name' => 'billNo', 'value' => $billNo),
                array('name' => 'billStartDate', 'value' => $billStartDate),
                array('name' => 'charge', 'value' => $charge),
                array('name' => 'claimCode', 'value' => $claimCode),
                array('name' => 'claimedLine', 'value' => $claimedLine),
                array('name' => 'compCauseId', 'value' => $compCauseId),
                array('name' => 'compContent', 'value' => $compContent),
                array('name' => 'compGroupId', 'value' => $compGroupId),
                array('name' => 'compTypeId', 'value' => $compTypeId),
                array('name' => 'complainId', 'value' => $complainId),
                array('name' => 'complainerAdress', 'value' => $complainerAdress),
                array('name' => 'complainerIsOther', 'value' => $complainerIsOther),
                array('name' => 'complainerName', 'value' => $complainerName),
                array('name' => 'complainerPassport', 'value' => $complainerPassport),
                array('name' => 'complainerPhone', 'value' => $complainerPhone),
                array('name' => 'complainerEmail', 'value' => $complainerEmail),
                array('name' => 'contractId', 'value' => $contractId),
                array('name' => 'contractNo', 'value' => $contractNo),
                array('name' => 'custLimitDate', 'value' => $custLimitDate),
                array('name' => 'depId', 'value' => $depId),
                array('name' => 'fileAttatch', 'value' => $fileAttatch),
                array('name' => 'fileAttatchName', 'value' => $fileAttatchName),
                array('name' => 'imsi', 'value' => $imsi),
                array('name' => 'latDatetimeUsing', 'value' => $latDatetimeUsing),
                array('name' => 'number', 'value' => $number),
                array('name' => 'placeError', 'value' => $placeError),
                array('name' => 'priorityId', 'value' => $priorityId),
                array('name' => 'resultContent', 'value' => $resultContent),
                array('name' => 'satisfiedLevel', 'value' => $satisfiedLevel),
                array('name' => 'serial', 'value' => $serial),
                array('name' => 'serviceType', 'value' => $serviceType),
                array('name' => 'shopId', 'value' => $shopId),
                array('name' => 'subId', 'value' => $subId),
                array('name' => 'userName', 'value' => $userName),
                array('name' => 'acceptSourceId', 'value' => $acceptSourceId),
                array('name' => 'districtCode', 'value' => $districtCode),
                array('name' => 'provinceCode', 'value' => $provinceCode),

                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            )
        );

        sfContext::getInstance()->getLogger()->log('[CC - Update khieu nai] createComplain Begin,  args=' .json_encode($args) , sfLogger::ERR);

        if (!$this->client) {
            return false;
        }

        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
//          MVPTranLogDb::saveLog($userName, json_encode($args), MVPTranLogDb::exception, MVPTranLogDb::error,MVPTranLogDb::khieu_nai);
            sfContext::getInstance()->getLogger()->log('[CC - Update khieu nai] createComplain exception, msg= ' . $e->getMessage() , sfLogger::ERR);
        }
        sfContext::getInstance()->getLogger()->log('[CC - Update khieu nai] createComplain result=' . json_encode($result), sfLogger::ERR);
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if ($value->errorCode == '00') {
//              MVPTranLogDb::saveLog($userName, json_encode($args), $value->errorCode, MVPTranLogDb::success,MVPTranLogDb::khieu_nai);
                return $value->description;
            }
        }
//        MVPTranLogDb::saveLog($userName, json_encode($args), MVPTranLogDb::resultFalse, MVPTranLogDb::error,MVPTranLogDb::khieu_nai);
        return false;
    }

    /*
     * Webservice CM
     */

    public function viewSubscriberByCustomer($firstname, $lastname,$phone,$limit)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewSubscriberByCustomer',
            'param' => array(
                array('name'=>'isdn','value' => $phone),
                array('name'=>'firstName','value'=>$firstname),
                array('name'=>'lastName','value'=>$lastname),
                array('name'=>'limit','value'=>$limit),
                array('name'=>'accepted','value'=>'1'),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),

            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Tra cuu tai khoan cung mang], viewSubscriberByCustomer begin, args=' , sfLogger::ERR);

        if (!$this->client) return false;
        $result = false;

        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Tra cuu tai khoan cung mang], viewSubscriberByCustomer soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if ($value->code=='1'){
                sfContext::getInstance()->getLogger()->log('[CM - Tra cuu tai khoan cung mang], viewSubscriberByCustomer soap call exception, msg= Success, args=' . json_encode($result), sfLogger::ERR);
                if(isset($value->lstWSSubscriber))
                    return $value->lstWSSubscriber;
                return false;
            }

        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Tra cuu tai khoan cung mang], viewSubscriberByCustomer result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return $result;
    }

    /*
     * <isdn>?</isdn>  số thuê bao cần chặn
         <!--Optional:-->
         <imei>?</imei>  imei cần chặn
         <!--Optional:-->
         <subId>?</subId>  mã thuê bao tương ứng với số thuê bao cần chặn
         <!--Optional:-->
         <imsi>?</imsi>  số imsi của thuê bao cần chặn
         <!--Optional:-->
         <model>?</model>  tên của dòng máy cần chặn (ví dụ: NOKIA 1100, …)
         <!--Optional:-->
         <subType>?</subType>  Loại thuê bao: 1: thuê bao trả trước, 0: thuê bao trả sau
         <!--Optional:-->
         <note>?</note>  ghi chú khi block
         <!--Optional:-->
         <blockCode>?</blockCode>  mã block (khi thực hiện unblock)
         <!--Optional:-->
         <blockWay>?</blockWay>  Phương thức chặn, mở chặn. IMEI  chặn/mở theo IMEI, LINE  Chặn/mở theo máy, ALL  Chặn/mở cả 2
         <!--Optional:-->
         <blockType>?</blockType>  Hình thức chặn/ mở: BLOCK: chặn, UNBLOCK: mở
     * */

    public function blockUnblockImeiAndLine($isdn,$imei,$model,$subType,$note,$blockCode,
                                            $blockWay,$blockType)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'blockUnblockImeiAndLine',
            'param' => array(
                array('name'=>'isdn','value' => $isdn),
                array('name' => 'imei', 'value' => $imei),
//                array('name'=>'subId','value'=>$subId),
                array('name'=>'model','value'=>$model),
                array('name'=>'subType','value'=>$subType),
                array('name'=>'note','value'=>$note),
                array('name'=>'blockCode','value'=>$blockCode),
                array('name'=>'blockWay','value' => $blockWay),
                array('name'=>'blockType','value' => $blockType),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockUnblockImeiAndLine begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;

//        if ($type == 0)
//            $logType = MVPTranLogDb::khoa_tai_khoan_1_2_chieu;
//        else
//            $logType = MVPTranLogDb::mo_tai_khoan_1_2_chieu;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::exception, MVPTranLogDb::error,"");
            sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockUnblockImeiAndLine soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                MVPTranLogDb::saveLog($isdn, json_encode($args), $errCode, MVPTranLogDb::success, '');
                sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockUnblockImeiAndLine errCode=' . $errCode . ', result=' . json_encode($result), sfLogger::ERR);
                if($blockType=='BLOCK'){
                    return $value->description;//neu la bock thi tra ve ma block
                }else{
                    return true;
                }
            }
        } else {
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::resultFalse, MVPTranLogDb::error, '');
            sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockUnblockImeiAndLine result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    /*  blockOpen: 0 – Block / 1 – Open
       isdn: số thuê bao
       numway: 1 | 2 chiều
       shopcode: mã của hàng nhân viên thực hiện
       username: tên nhân viên thực hiện
       serviceType: 1- trả sau / 2 – trả trước
       telecomService: M – Mobile / H – Homephone / A – ADSL / F – FTTH (Hiện tại chỉ có Mobile thì truyền M)
    */
    public function blockOpenSubscriber($type,$isdn,$numway,$shopcode,$username,$serviceType,$telecomService)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'blockOpenSubscriber',
            'param' => array(
                array('name'=>'blockOpen','value' => $type),
                array('name'=>'isdn','value' => $isdn),
                array('name'=>'numway','value' => $numway),
                array('name'=>'serviceType','value' => $serviceType),
                array('name'=>'shopCode','value' => $shopcode),
                array('name'=>'telecomService','value' => $telecomService),
                array('name' => 'username', 'value' => $this->$username),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockOpenSubscriber begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;

        if ($type == 0)
            $logType = MVPTranLogDb::khoa_tai_khoan_1_2_chieu;
        else
            $logType = MVPTranLogDb::mo_tai_khoan_1_2_chieu;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));

        } catch (Exception $e) {
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::exception, MVPTranLogDb::error,$logType);
            sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockOpenSubscriber soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                MVPTranLogDb::saveLog($isdn, json_encode($args), $errCode, MVPTranLogDb::success, $logType);
                sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockOpenSubscriber errCode=' . $errCode . ', result=' . json_encode($result), sfLogger::ERR);
                return true;
            }
        } else {
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::resultFalse, MVPTranLogDb::error, $logType);
            sfContext::getInstance()->getLogger()->log('[CM - Khoa_Mo khoa tai khoan], blockOpenSubscriber result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }
    /*
     * Cap nhat dia chi thanh toan
     */
    public function  updatePaymentAddress($isdn,$province,$district,$preceinct, $areaCode,$address,$shopcode,$username,$reasonId)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'updatePaymentAddress',
            'param' => array(
                array('name'=>'areaCode','value' => $areaCode),
                array('name'=>'district','value' => $district),
                array('name'=>'isdn','value' => $isdn),
                array('name'=>'paymentAddress','value' => $address),
                array('name'=>'precinct','value' => $preceinct),
                array('name'=>'province','value' => $province),
                array('name'=>'reasonId','value' => $reasonId),
                array('name'=>'shopCode','value' => $shopcode),
                array('name' => 'username', 'value' => $username),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Update dia chi thanh toan], updatePaymentAddress begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;

        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {

            sfContext::getInstance()->getLogger()->log('[CM - Update dia chi thanh toan], updatePaymentAddress soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::exception, MVPTranLogDb::error,MVPTranLogDb::thay_doi_dia_chi_thanh_toan_cuoc);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");

            sfContext::getInstance()->getLogger()->log('[CM - Update dia chi thanh toan], updatePaymentAddress code=' . $result->return->code . '; isdn=' . $isdn .', result=' . json_encode($result), sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), $value->code, MVPTranLogDb::success, MVPTranLogDb::thay_doi_dia_chi_thanh_toan_cuoc);
            if($value->code=='1'){
                return true;
            }
            return false;
        } else {

            sfContext::getInstance()->getLogger()->log('[CM - Update dia chi thanh toan], updatePaymentAddress result=false, result=' . json_encode($result), sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::resultFalse, MVPTranLogDb::error, MVPTranLogDb::thay_doi_dia_chi_thanh_toan_cuoc);
        }
        return $result;
    }

    /*
     * Ham lay dia chi thanh toan hien tai
     */
    public function viewPaymentAddress($isdn)
    {
        sfContext::getInstance()->getLogger()->log('[WsMvpSubcriberClient], viewPaymentAddress begin', sfLogger::ERR);
        if (!$this->client) return false;
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewPaymentAddress',
            'param' => array(
                array('name'=>'isdn','value' => $isdn),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Lay dia chi thanh toan], viewPaymentAddress begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;

        $result = false;

        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay dia chi thanh toan], viewPaymentAddress soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CM - Lay dia chi thanh toan], viewPaymentAddress soap call return value=' . json_encode($value) , sfLogger::ERR);
            if($value->code=='1'){
                return $value->paymentAddress;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay dia chi thanh toan], viewPaymentAddress result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return $result;
    }

    /*
     * Ham cap nhat thong tin khach hang
     */
    public function  updateCustomerInfor($isdn,$province,$district,$preceinct, $areaCode,$address,$shopcode,$username,$reasonId,$birthday,$contact,$email)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'updateCustomerInfor',
            'param' => array(
                array('name'=>'areaCode','value' => $areaCode),
                array('name'=>'birthDate','value' => $birthday),
                array('name'=>'contactNumber','value' => $contact),
                array('name'=>'customerAddress','value' => $address),
                array('name'=>'district','value' => $district),
                array('name'=>'email','value' => $email),
                array('name'=>'isdn','value' => $isdn),
                array('name'=>'precinct','value' => $preceinct),
                array('name'=>'province','value' => $province),
                array('name'=>'reasonId','value' => $reasonId),
                array('name'=>'shopCode','value' => $shopcode),
                array('name' => 'username', 'value' => $isdn),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Update thong tin ca nhan], updateCustomerInfor begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Update thong tin ca nhan], updateCustomerInfor soap call exception, msg=' . $e->getMessage(), sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::exception, MVPTranLogDb::error,MVPTranLogDb::thay_doi_thong_tin_ca_nhan);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CM - Update thong tin ca nhan], updateCustomerInfor code=' . $result->return->code . '; isdn=' . $isdn .', result=' . json_encode($result), sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), $value->code, MVPTranLogDb::success, MVPTranLogDb::thay_doi_thong_tin_ca_nhan);
            if($value->code=='1'){
                return true;
            }else
                return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Update thong tin ca nhan], updateCustomerInfor result=false, result=' . json_encode($result), sfLogger::ERR);
            MVPTranLogDb::saveLog($isdn, json_encode($args), MVPTranLogDb::resultFalse, MVPTranLogDb::error, MVPTranLogDb::thay_doi_thong_tin_ca_nhan);
        }
        return $result;
    }

    public function viewCustomerInforByIsdn($isdn)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewCustomerInforByIsdn',
            'param' => array(
                array('name'=>'isdn','value' => $isdn),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CM - Lay thong tin khach hang], viewCustomerInforByIsdn begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;

        $result = false;

        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay thong tin khach hang], viewCustomerInforByIsdn soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if($value->code=='1'){
                return $value->customer;
            }

        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay thong tin khach hang], viewCustomerInforByIsdn result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return $result;
    }

    public function getSubscriberExist($isdn , $idType , $idNo)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'checkSubscriberExist',
            'param' => array(
                array('name'=>'idNo','value' => $idNo),
                array('name'=>'idType','value' => $idType),
                array('name'=>'isdn','value' => $isdn),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),

            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist begin, args=', sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
//            var_dump($result);die;

        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            if($value->code=='1'){
                return $value->checkedSubscriber;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return $result;
    }

    public function viewSubscriberByIdNo($idType , $idNo)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewSubscriberByIdNo',
            'param' => array(
                array('name'=>'idNo','value' => $idNo),
                array('name'=>'idType','value' => $idType),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - danh sach tai khoan], viewSubscriberByIdNo begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - danh sach tai khoan], viewSubscriberByIdNo soap call exception, msg=' . $e->getMessage() . ', args=' , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CM - danh sach tai khoan], viewSubscriberByIdNo return code=' . $value->code .', result=' . json_encode($result), sfLogger::ERR);
            if ($value->code=='1'){
                if(isset($value->lstWSSubscriber))
                return $value->lstWSSubscriber;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - danh sach tai khoan], viewSubscriberByIdNo result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return $result;
    }

    public function checkSubscriberExist($isdn , $idType , $idNo)
    {

        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'checkSubscriberExist',
            'param' => array(
                array('name'=>'idNo','value' => $idNo),
                array('name'=>'idType','value' => $idType),
                array('name'=>'isdn','value' => $isdn),

                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->checkedSubscriber->isExist;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Kiem tra thue bao], checkSubscriberExist result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListProvince(){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListProvinceCM',
            'param' => array(
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach tinh thanh], getListProvince begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach tinh thanh], getListProvince soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->lstWSArea;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach tinh thanh], getListProvince result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListDistrictByProvince($province){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListDistrictByProvinceCM',
            'param' => array(
                array('name' => 'province', 'value' => $province),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach quan huyen], getListDistrictByProvince begin, args=', sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach quan huyen], getListDistrictByProvince soap call exception, msg=' . $e->getMessage(), sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
//            var_dump($result);die;
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->lstWSArea;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach quan huyen], getListDistrictByProvince result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function getListPrecinctByProvinceAndDistrict($province,$district){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListPrecinctByProvinceAndDistrictCM',
            'param' => array(
                array('name' => 'province', 'value' => $province),
                array('name' => 'district', 'value' => $district),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach xa phuong], getListPrecinctByProvinceAndDistrict begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach xa phuong], getListPrecinctByProvinceAndDistrict soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");

            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->lstWSArea;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay danh sach xa phuong], getListPrecinctByProvinceAndDistrict result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function getProvinceNameByCode($province){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getProvinceNameByCodeCM',
            'param' => array(
                array('name' => 'province', 'value' => $province),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay ten tinh], getProvinceNameByCode begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten tinh], getProvinceNameByCode soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->wsArea->name;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten tinh], getProvinceNameByCode result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function getDistrictNameByCode($province,$district){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getDistrictNameByCodeCM',
            'param' => array(
                array('name' => 'province', 'value' => $province),
                array('name' => 'district', 'value' => $district),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay ten quan huyen], getDistrictNameByCode begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten quan huyen], getDistrictNameByCode soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->wsArea->name;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten quan huyen], getDistrictNameByCode result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }
    public  function getPrecinctNameByCode($province,$district,$precinct){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getPrecinctNameByCodeCM',
            'param' => array(
                array('name' => 'province', 'value' => $province),
                array('name' => 'district', 'value' => $district),
                array('name' => 'precinct', 'value' => $precinct),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - Lay ten phuong xa], getPrecinctNameByCode begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten phuong xa], getPrecinctNameByCode soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                return $value->wsArea->fullName;
            }
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - Lay ten phuong xa], getPrecinctNameByCode result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    /***
     * Public or private infomation msisdn
     */
    public function acceptedPublicPersionalIsdnAndName($isnd, $telecomService, $serviceType, $accepted){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'acceptedPublicPersionalIsdnAndNameCM',
            'param' => array(
                array('name' => 'isdn', 'value' => $isnd),
                array('name' => 'telecomService', 'value' => $telecomService),
                array('name' => 'serviceType', 'value' => $serviceType),
                array('name' => 'accepted', 'value' => $accepted),
                array('name' => 'wsUsername', 'value' => $this->cmUsername),
                array('name' => 'wsPassword', 'value' => $this->cmPassword),
            ),
        );

        //
        sfContext::getInstance()->getLogger()->log('[CM - public/private thong tin], acceptedPublicPersionalIsdnAndName begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CM - public/private thong tin], acceptedPublicPersionalIsdnAndName soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            sfContext::getInstance()->getLogger()->log('[CM - public/private thong tin], acceptedPublicPersionalIsdnAndName soap call ' . ', $result=' . json_encode($result), sfLogger::ERR);
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->code;
            if ($errCode == '1') {
                return true;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CM - public/private thong tin], acceptedPublicPersionalIsdnAndName result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getComplainInfo($isnd,$reclaimationNumber)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getComplainInfo',
            'param' => array(
                array('name' => 'isdn', 'value' => $isnd),
                array('name' => 'reclaimationNumber', 'value' => $reclaimationNumber),

                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - Lay thong tin khieu nai], getComplainInfo begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay thong tin khieu nai], getComplainInfo soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - Lay thong tin khieu nai], getComplainInfo soap call exception,  value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return $value->infoComplain;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - Lay thong tin khieu nai], getComplainInfo result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function createIndecopi($address,$compTypeId,$description,$dniRucNumber,$documentType,
                    $email,$fullName,$motherFatherName,$phoneNumber,$placeError,$typeReclaimation)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'createIndecopi',
            'param' => array(
                array('name' => 'address', 'value' => $address),
                array('name' => 'compTypeId', 'value' => $compTypeId),
                array('name' => 'complainId', 'value' => ''),
                array('name' => 'deadlineForCustomer', 'value' => ''),
                array('name' => 'description', 'value' => $description),
                array('name' => 'dniRucNumber', 'value' => $dniRucNumber),
                array('name' => 'documentType', 'value' => $documentType),
                array('name' => 'email', 'value' => $email),
                array('name' => 'fullName', 'value' => $fullName),
                array('name' => 'groupId', 'value' => ''),
                array('name' => 'isSendSMS', 'value' => ''),
                array('name' => 'latDatetimeUsing', 'value' => ''),
                array('name' => 'motherFatherName', 'value' => $motherFatherName),
                array('name' => 'numberDocument', 'value' => ''),
                array('name' => 'phoneNumber', 'value' => $phoneNumber),
                array('name' => 'placeError', 'value' => $placeError),
                array('name' => 'transferBO', 'value' => ''),
                array('name' => 'typeReclaimation', 'value' => $typeReclaimation),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - Nhap thong tin khieu nai], createIndecopi begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Nhap thong tin khieu nai], createIndecopi soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - Nhap thong tin khieu nai], createIndecopi soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return $value->description;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - Nhap thong tin khieu nai], createIndecopi result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListIMEI($isdn)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'eir_query_imei',
            'param' => array(
                array('name' => 'msisdn', 'value' => $isdn),
                array('name' => 'partyCode', 'value' => 'VTP'),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach IMEI], eir_query_imei begin, args=', sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach IMEI], eir_query_imei soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach IMEI], eir_query_imei soap call exception, result=' . json_encode($result), sfLogger::ERR);
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->error;
            if ($errCode == '0') {
                if(isset($value->param)){
                    return $value->param;
                }
            }
            return false;
        }else {
            sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach IMEI], eir_query_imei result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListModel($tac)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'eir_query_device_type',
            'param' => array(
                array('name' => 'tac', 'value' => $tac),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - Lay ten nha cung cap], eir_query_device_type begin, args=' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay ten nha cung cap], eir_query_device_type soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay ten nha cung cap], eir_query_device_type soap call exception,result=' . json_encode($result), sfLogger::ERR);
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->error;
            if ($errCode == '0') {
                if(isset($value->param)){
                    $param=$value->param;
                    $model='';
//                    $manufacturer='';
                    foreach ($param as $item){
                        $items=(array)$item;
                        $attributes=$items['@attributes'];
                        if($attributes->name=='model'){
                            $model=$attributes->value;
                        }
//                        if($attributes->name=='manufacturer'){
//                            $manufacturer=$attributes->value;
//                        }
                    }
                    return $model;// .' - '. $manufacturer;
                }

            }
            return false;
        }else {
            sfContext::getInstance()->getLogger()->log('[CC - Lay ten nha cung cap], eir_query_device_type result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getImeiStatus($imei)
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'eir_query_imsi',
            'param' => array(
                array('name' => 'imei', 'value' => $imei),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - Lay trạng thai imei], eir_query_device_type begin,' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay trạng thai imei], eir_query_device_type soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }
        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->error;
            if ($errCode == '0') {
                if(isset($value->param)){
                    $items=(array)$value->param;
                    $attributes=$items['@attributes'];
                    return $attributes->value;
                }else{
                    return '';
                }

            }
            return false;
        }else {
            sfContext::getInstance()->getLogger()->log('[CC - Lay trạng thai imei], eir_query_device_type result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListCompPriorityIndecopi()
    {
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListCompPriorityIndecopi',
            'param' => array(
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach Reclamation], getListCompPriorityIndecopi begin,' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach Reclamation], getListCompPriorityIndecopi soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return $value->listPriority;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - Lay danh sach Reclamation], getListCompPriorityIndecopi result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    /*
     * 21/03/2014
     * Cap nhat thong tin khieu nai theo yc moi
     * Ham xac thuc thong tin
     */
    public function checkComplain($isdn, $reportNo, $claimNo){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'checkComplain',
            'param' => array(
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'reportNo', 'value' => $reportNo),
                array('name' => 'claimNo', 'value' => $claimNo),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - Check], checkComplain begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Check], checkComplain soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - Check], checkComplain soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                if($value->description!=='NOTFOUND')
                return $value->description;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - Check], checkComplain result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function updateComplain($complainId,$note,$resourceType,$email){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'updateComplain',
            'param' => array(
                array('name' => 'complainId', 'value' => $complainId),
                array('name' => 'note', 'value' => $note),
                array('name' => 'resourceType', 'value' => $resourceType),
                array('name' => 'email', 'value' => $email),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - Update complaint], Update complaint begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - Update complaint], Update complaint soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - Update complaint], Update complaint soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return true;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - Update complaint], Update complaint result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    /*
     *
     */
    public  function getCompInfo($isdn,$claimNo){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getCompInfo',
            'param' => array(
                array('name' => 'claimNo', 'value' => $claimNo),
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - getCompInfo], getCompInfo begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - getCompInfo], getCompInfo soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - getCompInfo], getCompInfo soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                return $value->lstSubComp;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - getCompInfo], getCompInfo result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public function getListAcceptSource(){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'getListAcceptSource',
            'param' => array(
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );

        sfContext::getInstance()->getLogger()->log('[CC - getListAcceptSource], getListAcceptSource begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - getListAcceptSource], getListAcceptSource soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - getListAcceptSource], getListAcceptSource soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                if (isset($value->listAcceptSource))
                return $value->listAcceptSource;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - getListAcceptSource], getListAcceptSource result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function viewComplainInfo($isdn,$reclaimationNumber){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewComplainInfo',
            'param' => array(
                array('name' => 'reclaimationNumber', 'value' => $reclaimationNumber),
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - viewComplainInfo], viewComplainInfo begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - viewComplainInfo], viewComplainInfo soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - viewComplainInfo], viewComplainInfo soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                if(isset($value->infoComplain))
                return $value->infoComplain;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - viewComplainInfo], viewComplainInfo result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

    public  function viewListAttachFile($isdn,$reclaimationNumber){
        $args = array(
            'username' => $this->bccsUsername,
            'password' => $this->bccsPassword,
            'wscode' => 'viewListAttachFile',
            'param' => array(
                array('name' => 'reclaimationNumber', 'value' => $reclaimationNumber),
                array('name' => 'isdn', 'value' => $isdn),
                array('name' => 'username', 'value' => $this->subUsername),
                array('name' => 'password', 'value' => $this->subPassword),
            ),
        );
        sfContext::getInstance()->getLogger()->log('[CC - viewListAttachFile], viewListAttachFile begin, ' , sfLogger::ERR);
        if (!$this->client) return false;
        $result = false;
        try {
            $result = $this->client->__soapCall('gwOperation', array($args));
        } catch (Exception $e) {
            sfContext::getInstance()->getLogger()->log('[CC - viewListAttachFile], viewListAttachFile soap call exception, msg=' . $e->getMessage() , sfLogger::ERR);
            return false;
        }

        if ($result !== false) {
            $value = MVPHelper::getOriginalBccsGW($result->original, "<return>", "</return>");
            sfContext::getInstance()->getLogger()->log('[CC - viewListAttachFile], viewListAttachFile soap call exception, value=' . json_encode($value), sfLogger::ERR);
            $errCode = $value->errorCode;
            if ($errCode == '00') {
                if(isset($value->listFile))
                    return $value->listFile;
            }
            return false;
        } else {
            sfContext::getInstance()->getLogger()->log('[CC - viewListAttachFile], viewListAttachFile result=false, result=' . json_encode($result), sfLogger::ERR);
        }
        return false;
    }

}