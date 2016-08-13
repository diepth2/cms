<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diepth2
 * Date: 27/06/136
 * Time: 9:17 AM
 * To change this template use File | Settings | File Templates.
 */
class WsChargeVNP
{
    private $m_PartnerID;
    private $m_MPIN;
    private $m_UserName;
    private $m_Pass;
    private $m_PartnerCode;
    private $m_Target;
    private $ObjLogin;

    /**
     *
     * @var SoapClient
     */
    private $client;
    public $soapClient;

    public function __construct()
    {
        $yamlFile = sfConfig::get('sf_app_dir') . '/config/bccs.yml';
        $arrData = sfYaml::load($yamlFile);
        $wsdl = $arrData['bccs']['url_megapay'];
        $connectTimeout = $arrData['timeout']['connect'];
        $responseTimeout = $arrData['timeout']['response'];

        $this->m_PartnerID = $arrData['bccs']['m_PartnerID'];
        $this->m_MPIN = $arrData['bccs']['m_MPIN'];
        $this->m_UserName = $arrData['bccs']['m_UserName'];
        $this->m_Pass = $arrData['bccs']['m_Pass'];
        $this->m_PartnerCode = $arrData['bccs']['m_PartnerCode'];
        $this->m_Target = $arrData['bccs']['m_Target'];
        $ObjLogin= new loginResponse();
        $RSAClass = new ClsCryptor();
        //Ham thuc hien lay public key cua EPAy tu file pem
        $RSAClass->GetpublicKeyFrompemFile("./Key/Epay_Public_key.pem");
        try{
            $EncrypedPass = $RSAClass -> encrypt($this-> m_Pass);
        }
        catch(Exception  $ex){
        }
        $Pass = base64_encode($EncrypedPass);
        try {
            sfContext::getInstance()->getLogger()->log('dang nhap ws');
            $this->soapClient = new VtpSoapClient($wsdl, array('connect_timeout' => $connectTimeout, 'timeout' => $responseTimeout));
            $result = $this->soapClient->login( $this->m_UserName, $Pass,$this->m_PartnerID);
        } catch (Exception $e) {
            $msg = $e->getMessage();
            sfContext::getInstance()->getLogger()->log('[__construct] khong khoi tao duoc client:'. $wsdl . ' msg: ' . $msg, sfLogger::ERR);
            $this->errorMessage = 'dang nhap that bai';
            throw new Exception($msg, $e->getCode());
        }
        $ObjLogin->m_Sessage = $result->message;

        //$Obj->m_SessionID = $result->sessionid;
        $ObjLogin->m_Status = $result->status;

        //Ham thuc hien lay private key cua doi tac tu file pem
        $RSAClass->GetPrivatekeyFrompemFile("./Key/private_key.pem");
        try{
            $Session_Decryped =   $RSAClass -> decrypt(base64_decode($result->sessionid));
            $ObjLogin->m_SessionID = $this->Hextobyte( $Session_Decryped) ;
        }
        catch(Exception $ex){
            sfContext::getInstance()->getLogger()->log('[__construct] co loi khi gia ma:'. $wsdl . ' msg: ' . $ex->getMessage(), sfLogger::ERR);
            $this->errorMessage = 'dang nhap that bai';
            throw new Exception( $ex->getMessage(), $ex->getCode());        }
        //print_r($Obj->m_SessionID) ;

        $ObjLogin->m_TransID  = $this->m_PartnerCode.date("YmdHms");;
        $this->ObjLogin = $ObjLogin;


    }

    /**
     * Lay ket qua thong bao loi
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getM_PartnerID()
    {
        return $this->m_PartnerID;
    }

    public function getM_MPIN()
    {
        return $this->m_MPIN;
    }

    public function getM_UserName()
    {
        return $this->m_UserName;
    }

    public function getM_Pass()
    {
        return $this->m_Pass;
    }
    public function getM_PartnerCode()
    {
        return $this->m_PartnerCode;
    }

    public function getM_Target()
    {
        return $this->m_Target;
    }
    public function  cardCharging($m_Card_DATA){
        $sessionID = bin2hex($this->ObjLogin->m_SessionID);

        $ObjCardCharging = new CardChargingResponse();
        $key = $this->Hextobyte($sessionID);
        //print_r($this-> m_SessionID);
        //print_r($this->m_MPIN);
        //$keytesst = base64_encode($key);
        //print_r($keytesst);
        $ObjTriptDes = new TriptDes($key);
        try {
            $strEncreped =  $ObjTriptDes->encrypt($this->m_MPIN);
            //print_r ($strEncreped);
            //$decode =  $ObjTriptDes->decrypt(  $strEncreped);
            //print_r ($decode);
            $Mpin = $this->  ByteToHex($strEncreped);

            $Card_DATA = $this->  ByteToHex( $ObjTriptDes->encrypt($m_Card_DATA));
            //print_r($Card_DATA);

        }catch(Exception $ex){
            sfContext::getInstance()->getLogger()->log('[cardCharging] xau ra loi trong qua trinh ma hoa the');
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
        try{
            //print_r($this);
            $logger = new sfFileLogger(new sfEventDispatcher(), array('file' => sfConfig::get('sf_log_dir') . '/charge' . date('d') . '.log'));
            $logger->log("m_TransID:". $this->ObjLogin->m_TransID. "|m_UserName:" . $this->m_UserName
                . "|m_PartnerID:" . $this->m_PartnerID. "|Mpin:". $Mpin . "|m_Target:" . $this->m_Target . "|Card_DATA: " . $Card_DATA . "|sessionID:" . $sessionID);
            $result = $this->soapClient->cardCharging( $this->ObjLogin->m_TransID , $this->m_UserName, $this->m_PartnerID, $Mpin, $this->m_Target, $Card_DATA ,md5($sessionID)); // goi ham login de lay session id du lieu tra ve la mot mang voi cac thong tin message, sessionid,status,transid
            //var_dump($result);die;
            $this->soapClient->httpsocket = null;
            //var_dump($result);die;
            //print_r($result);
        }
        catch(Exception $ex){
            //echo "Co loi xay ra khi thuc hien charging: ".$ex;
            $logger = new sfFileLogger(new sfEventDispatcher(), array('file' => sfConfig::get('sf_log_dir') . '/err' . date('d') . '.log'));
            $logger->log("m_TransID:". $this->ObjLogin->m_TransID. "|m_UserName:" . $this->m_UserName
                . "|m_PartnerID:" . $this->m_PartnerID. "|Mpin:". $Mpin . "|m_Target:" . $this->m_Target . "|Card_DATA: " . $Card_DATA . "|sessionID:" . $sessionID);
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
        $ObjCardCharging->m_Status = $result->status;
        $ObjCardCharging->m_Message = $result->message;
        $ObjCardCharging->m_TRANSID = $result->transid;
        $ObjCardCharging->m_AMOUNT = $result->amount;
        $resAmount =  $ObjTriptDes->decrypt($this-> Hextobyte( $result->responseamount));
        $ObjCardCharging->m_RESPONSEAMOUNT = $resAmount ;//$result->responseamount;
        if($ObjCardCharging->m_Status == 3 || $ObjCardCharging->m_Status == 7)
            $this->SessionID = null;
        //print_r($Obj                    return  $Obj;
        return $ObjCardCharging;
    }
    function Hextobyte($strHex){
        $string='';
        for ($i=0; $i < strlen($strHex)-1; $i+=2)
        {
            $string .= chr(hexdec($strHex[$i].$strHex[$i+1]));
        }
        return  $string;
    }
    function ByteToHex($strHex){
        return   bin2hex ($strHex);
    }
    
    
}
class TriptDes{
    private $DessKey;
    public function TriptDes($key){
        $this->DessKey= $key;
    }
    public function decrypt($text) {
        $key = $this->DessKey;
        $size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_3DES, $key, $text, MCRYPT_MODE_ECB,$iv);
        return rtrim($this->pkcs5_unpad($decrypted) );
    }

    public function encrypt($text) {
        $key = $this->DessKey;
        $text=$this->pkcs5_pad($text,8);  // AES?16????????
        $size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($size, MCRYPT_RAND);
        $bin = pack('H*', bin2hex($text) );
        $encrypted = mcrypt_encrypt(MCRYPT_3DES, $key, $bin, MCRYPT_MODE_ECB,$iv);
        return $encrypted;
    }

    function pkcs5_pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }

}
Class loginResponse{
    Public $m_Status;
    Public $m_Sessage;
    ///
    // Session do VNPT EPAY cung cap cho doi t�c d�ng de ma hoa du lieu va xac thuc thong tin.
    //SessinID gui ve tu VNPT EPAY duoc ma hoa bang public key cua merchant theo thuat toan RSA
    ///
    Public $m_SessionID;
    Public $m_TransID;
}
Class logout{
    Public $m_UserName;
    Public $m_PartnerID;
    Public $m_SessionID;
    public $soapClient;
    function   logout_(){
        $Ojb = new LogoutResponse();

        //$soapClient = new Soapclient("http://192.168.0.85:10001/CardChargingGW_0108/services/Services?wsdl");
        try{
            $result =  $this->soapClient->logout( $this->m_UserName, $this->m_PartnerID,md5($this->m_SessionID)); // goi ham login de lay session id du lieu tra ve la mot mang voi cac thong tin message, sessionid,status,transid
        }
        catch(Exception $ex){}
        $Ojb->m_Status = $result->status;
        $Ojb->m_Message = $result->message;
        return  $Ojb;
    }
}
Class LogoutResponse{
    Public $m_Status;
    Public $m_Message;

}
Class CardChargingResponse{
    Public $m_Status;
    Public $m_Message;
    Public $m_TRANSID;
    Public $m_AMOUNT;
    Public $m_RESPONSEAMOUNT;

}

Class ChangePassword{
    Public $m_TransID;
    Public $m_UserName;
    Public $m_PartnerID;
    Public $m_OLD_PASSWORD;
    Public $m_NEW_PASSWORD;
    Public $m_SessionID;
    public $soapClient;
    function   ChangePassword_(){
        $Ojb = new ChangeResponse();
        $ObjTriptDes = new TriptDes($this-> m_SessionID);
        try {
            $OldPass =  $ObjTriptDes->EncrypTriptDes(  $this->m_OLD_PASSWORD);
            $NewPass = $ObjTriptDes->EncrypTriptDes(  $this->m_NEW_PASSWORD);
        }catch(Exception $ex){}
        //$soapClient = new Soapclient("http://192.168.0.85:10001/CardChargingGW_0108/services/Services?wsdl");
        try{
            $result = $this->soapClient->changePassword( $this->m_TransID , $this->m_UserName, $this->m_PartnerID, $OldPass, $NewPass ,md5($this->m_SessionID)); // goi ham login de lay session id du lieu tra ve la mot mang voi cac thong tin message, sessionid,status,transid
        }
        catch(Exception $ex){}
        $Ojb->m_Status = $result->status;
        $Ojb->m_Message = $result->message;
        return  $Ojb;
    }
}
Class ChangeResponse{
    Public $m_Status;
    Public $m_Message;
}
Class ChangMPin{
    Public $m_TransID;
    Public $m_UserName;
    Public $m_PartnerID;
    Public $m_OLD_OLD_MPIN;
    Public $m_NEW_MPIN;
    Public $m_SessionID;
    public $soapClient;
    function   ChangMPin_(){
        $Ojb = new ChangeResponse();
        $ObjTriptDes = new TriptDes($this-> m_SessionID);
        try {
            $OldMpin =  $ObjTriptDes->EncrypTriptDes(  $this->m_OLD_OLD_MPIN);
            $NewMpin = $ObjTriptDes->EncrypTriptDes(  $this->m_NEW_MPIN);
        }catch(Exception $ex){}


        //$soapClient = new Soapclient("http://192.168.0.85:10001/CardChargingGW_0108/services/Services?wsdl");
        try{
            $result = $this->soapClient->changeMPIN( $this->m_TransID , $this->m_UserName, $this->m_PartnerID, $OldMpin, $NewMpin ,md5($this->m_SessionID)); // goi ham login de lay session id du lieu tra ve la mot mang voi cac thong tin message, sessionid,status,transid
        }
        catch(Exception $ex){}
        $Ojb->m_Status = $result->status;
        $Ojb->m_Message = $result->message;
        return  $Ojb;
    }
}
class ClsCryptor{
    private  $RsaPublicKey;
    private  $RsaPrivateKey;
    private  $TripDesKey;
    public function GetpublicKeyFromCertFile($filePath)
    {
        $fp=fopen($filePath,"r");
        $pub_key=fread($fp,filesize($filePath));
        fclose($fp);
        openssl_get_publickey($pub_key);

        $this-> RsaPublicKey = $pub_key;
    }

    public function GetpublicKeyFrompemFile($filePath)
    {
        $fp=fopen($filePath,"r");
        $pub_key=fread($fp,filesize($filePath));
        fclose($fp);
        openssl_get_publickey($pub_key);
        //print_r($pub_key);
        $this-> RsaPublicKey = $pub_key;
        //print_r($this-> RsaPublicKey);
    }

    public function GetPrivatekeyFrompemFile($filePath)
    {
        $fp=fopen($filePath,"r");
        $pub_key=fread($fp,filesize($filePath));
        fclose($fp);
        $this-> RsaPrivateKey = $pub_key;


    }
    public function GetPrivate_Public_KeyFromPfxFile($filePath,$Passphase)
    {
        $p12cert = array();
        $fp=fopen($filePath,"r");
        $p12buf = fread($fp, filesize($filePath));
        fclose($fp);
        openssl_pkcs12_read($p12buf, $p12cert, $Passphase);
        $this-> RsaPrivateKey =  $p12cert['pkey'];
        $this-> RsaPublicKey = $p12cert['cert'];

    }

    function encrypt($source)
    {
        //path holds the certificate path present in the system
        $pub_key = $this -> RsaPublicKey;
        //$source="sumanth";
        $j=0;
        $x=strlen($source)/10;
        $y=floor($x);
        $crt='';
        //print_r($pub_key) ;
        for($i=0;$i<$y;$i++)
        {
            $crypttext='';

            openssl_public_encrypt(substr($source,$j,10),$crypttext,$pub_key);$j=$j+10;
            $crt.=$crypttext;
            $crt.=":::";
        }
        if((strlen($source)%10)>0)
        {
            openssl_public_encrypt(substr($source,$j),$crypttext,$pub_key);
            $crt.=$crypttext;
        }
        return($crt);

    }
    //Decryption with private key
    function decrypt($crypttext)
    {
        $priv_key = $this -> RsaPrivateKey;
        $tt=explode(":::",$crypttext);
        $cnt=count($tt);
        $i=0;
        $str='';
        while($i<$cnt)
        {
            openssl_private_decrypt($tt[$i],$str1,$priv_key);
            $str.=$str1;
            $i++;
        }
        return $str;
    }
}