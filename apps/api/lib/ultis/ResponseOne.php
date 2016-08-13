<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diepth2
 * Date: 6/18/14
 * Time: 9:57 PM
 * To change this template use File | Settings | File Templates.
 */

class ResponseOne{

    protected $data, $message, $code, $guide_text;

    /**
     * create the OCS_Result object
     * @param $data mixed the data to return
     */
    public function __construct($code=0, $message=null,$data=null, $guide_text = null) {
        $i18N = sfContext::getInstance()->getI18N();
        $message = $i18N->__($message);
        $response['errorCode'] = $code;
        $response['message'] = $message;
        if($data)
            foreach($data as $key => $value){
                $response[$key] = $value;
            }
        header('Content-type: application/json');
        if ($guide_text)
            $response['guide_text'] = $guide_text;
        $encoded = json_encode($response);
        exit($encoded);
    }
}
