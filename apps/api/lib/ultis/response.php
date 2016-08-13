<?php
/**
 * Created by JetBrains PhpStorm.
 * User: diepth2
 * Date: 6/18/14
 * Time: 9:57 PM
 * To change this template use File | Settings | File Templates.
 */

class Response{

    protected $data, $message, $code, $total_page, $guide_text;

    /**
     * create the OCS_Result object
     * @param $data mixed the data to return
     */
    public function __construct($code=0, $message=null, $data=null, $total_page= null, $guide_text = null) {
        $i18N = sfContext::getInstance()->getI18N();
        $message = $i18N->__($message);
        $response['errorCode'] = $code;
        $response['message'] = $message;
        if($code == 0)
            $response['data'] = $data;
        if ($total_page || $total_page == '0')
            $response['total_page'] = $total_page;
        if ($guide_text)
            $response['guide_text'] = $guide_text;
        header('Content-type: application/json');
        $encoded = json_encode($response);
        exit($encoded);
    }
}
