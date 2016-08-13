<?php

/*
 * To change this templates, choose Tools | Templates
 * and open the templates in the editor.
 */

/**
 * Description of ErrorCodeAbstract
 *
 * @author diepth2
 */
class ErrorCodeUtil {

    private static $defaultMessage = "Error code invalid";

    public static function getMessage($code, $message = false) {
        $message = $message ? $message : array();
        if (!is_numeric($code) ||
                !in_array($code, array_keys($message))
        ) {
            return ErrorCodeUtil::$defaultMessage;
        } else {
            return $message[$code];
        }
    }

}

?>
