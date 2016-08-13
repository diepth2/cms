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
class CallSoapErrorException extends Exception {

    //put your code here
    protected $message = "Call soap service error";

    /**
     * 
     * @param type $message
     * @param type $code
     * @param type $previous
     * @author diepth2 <diepth2@viettel.com>
     * @created_at: 4/16/14 1:47 PM
     */
    public function __construct($message = null, $code = null, $previous = null) {
        $msg = $message ? $message : $this->message;
        $errorCode = $code ? $code : 444;
        parent::__construct($msg, $errorCode, $previous);
    }

}

?>
