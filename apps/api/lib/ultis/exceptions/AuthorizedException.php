<?php

/*
 * To change this templates, choose Tools | Templates
 * and open the templates in the editor.
 */

/**
 * Description of AuthorizedException
 *
 * @author diepth2
 */
class AuthorizedException extends Exception {
    protected $message = 'token không tồn tại';

    /**
     * 
     * @param type $message
     * @param type $code
     * @param type $previous
     * @author diepth2 <diepth2@viettel.com>
     * @created_at: 4/16/14 1:47 PM
     */
    public function __construct($message = null, $code = null, $previous = null) {
        $i18N = sfContext::getInstance()->getI18N();
        $msg = $message ? $message : $this->message;
        $msg = $i18N->__($msg);
        $errorCode = $code ? $code : CommonErrorCode::TOKEN_NOT_EXIT;
        parent::__construct($msg, $errorCode, $previous);
    }

}

?>
