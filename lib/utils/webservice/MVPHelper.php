<?php
/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 1/2/14
 * Time: 2:46 PM
 * To change this template use File | Settings | File Templates.
 */
class MVPHelper
{
    const MOBILE_09x = 12;
    const MOBILE_9x = 13;
    const MOBILE_849x = 14;
    const MOBILE_SIMPLE = '09x';
    const MOBILE_GLOBAL = '849x';
    /**
     * @author ngoctv
     * @return  ham kiem tra token
     * @param $token can kiem tra
     */
    public static function validateToken($token) {
        $formValid = new BaseForm();
        if ($token == $formValid->getCSRFToken())
            return true;
        else
            return false;
    }

    /**
     * Ham nhu SECOND_TO_TIME trong MySQL?
     * @param int $secs So giay can quy doi
     * @return string
     */
    public static function formatTime($secs)
    {
        return str_pad(floor($secs / 3600), 2, "0", STR_PAD_LEFT) . ":" .
            str_pad(floor(($secs % 3600) / 60), 2, "0", STR_PAD_LEFT) . ":" .
            str_pad($secs % 60, 2, "0", STR_PAD_LEFT);
    }

    public static function generateRegcode($length = 8)
    {
        // start with a blank password
        $resCode = "";
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        // we refer to the length of $possible a few times, so let's grab it now
        $maxlength = strlen($possible);
        // check for length overflow and truncate if necessary
        if ($length > $maxlength) {
            $length = $maxlength;
        }
        // set up a counter for how many characters are in the password so far
        $i = 0;
        // add random characters to $password until $length is reached
        while ($i < $length) {
            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, $maxlength - 1), 1);
            // have we already used this character in $password?
            if (!strstr($resCode, $char)) {
                // no, so it's OK to add it onto the end of whatever we've already got...
                $resCode .= $char;
                // ... and increase the counter by one
                $i++;
            }
        }
        // done!
        return $resCode;
    }

    public static function checkMobileNum($phone)
    {
        return preg_match('@' . sfConfig::get('viettel_msisdn_validate',
            '^8496\d{7}$|^8497\d{7}$|^8498\d{7}$|^8416\d{8}$|0?96\d{7}$|0?97\d{7}$|^0?98\d{7}$|^0?16\d{8}$') . '@', trim($phone));
    }

    public static function checkHomePhone($phone)
    {
        return preg_match('/^(0|84)*(16|76|75|64|281|240|781|241|56|650|651|62|780|710|26|67|511|61|500|501|230|59|219|351|39|711|218|321|8|320|31|58|77|60|231|63|25|20|72|30|68|350|38|210|57|52|510|55|33|53|79|22|66|36|280|54|37|73|74|27|70|211|29|4)[0-9]{5,13}$/', trim($phone));
    }


    public static function checkMobileAndHomePhoneViettel($phone)
    {
        return preg_match('/^(0|84)*(16d|76|75|64|281|240|781|241|56|650|651|62|780|710|26|67|511|61|500|501|230|59|219|351|39|711|218|321|8|320|31|58|77|60|231|63|25|20|72|30|68|350|38|210|57|52|510|55|33|53|79|22|66|36|280|54|37|73|74|27|70|211|29|4)[0-9]$|' .
            '^8496\d{7}$/|^8497\d{7}$|^8498\d{7}$|^8416\d{8}$|0?96\d{7}$|0?97\d{7}$|^0?98\d{7}$|^0?16\d{8}$/', trim($phone));
    }

    public static function formatMobileNumber($phone, $type = self::MOBILE_09x)
    {
        $phone = (string)$phone;
        // Bo het cac ky tu khong phai so
        $phone = preg_replace('@[^0-9]@', '', $phone);
        if ($type == self::MOBILE_09x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                # do nothing
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                $phone = '0' . substr($phone, 2);
            } else { #975292582
                $phone = '0' . $phone;
            }
        } elseif ($type == self::MOBILE_849x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                $phone = '84' . substr($phone, 1);
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                # do nothing
            } else { #975292582
                $phone = '84' . $phone;
            }
        } elseif ($type == self::MOBILE_9x) {
            if (substr($phone, 0, 1) == '0') { #0975292582
                $phone = substr($phone, 1);
            } elseif (substr($phone, 0, 2) == '84') { #+84975292582
                $phone = substr($phone, 2);
            } else { #975292582
                # do nothing
            }
        } else {
            throw new Exception('Format dien thoai khong hop le', 113);
        }

        return $phone;
    }
    public static function isViettelPhoneNumber($phone_no)
    {
        $pattern = sfConfig::get('app_viettel_msisdn_validate',
            '/^8496\d{7}$|^8497\d{7}$|^8498\d{7}$|^8416\d{8}$|^0?96\d{7}$|^0?97\d{7}$|^0?98\d{7}$|^0?16\d{8}$|^16\d{7}$|^97\d{7}$/') ;
        preg_match($pattern, $phone_no, $matches);
        if (count($matches) > 0)
            return true;
        return false;
    }
    public static function strBeginWith($needle, $haystack)
    {
        return (substr($haystack, 0, strlen($needle)) == $needle);
    }

    public static function addCountryCodeToMsisdn($phoneNo)
    {
        if (self::isViettelPhoneNumber($phoneNo)) {
            $code=sfConfig::get('app_viettel_phone_country_code', '84');
            if (self::strBeginWith($code, $phoneNo)) {
                return $phoneNo;
            }
            else{
                return $code.$phoneNo;
            }
        }
    }

    /**
     * Bỏ tiếng việt có dấu
     * @param <type> $str
     * @return <type>
     */
    public static function removeSign($str)
    {
        $hasSign = array(
            'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ', '&agrave;', '&aacute;', '&acirc;', '&atilde;',
            'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', '&egrave;', '&eacute;', '&ecirc;',
            'ì', 'í', 'ị', 'ỉ', 'ĩ', '&igrave;', '&iacute;', '&icirc;',
            'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', '&ograve;', '&oacute;', '&ocirc;', '&otilde;',
            'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ', '&ugrave;', '&uacute;',
            'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', '&yacute;',
            'đ', '&eth;',
            'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;',
            'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', '&Egrave;', '&Eacute;', '&Ecirc;',
            'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', '&Igrave;', '&Iacute;', '&Icirc;',
            'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;',
            'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', '&Ugrave;', '&Uacute;',
            'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', '&Yacute;',
            'Đ', '&ETH;',
        );
        $noSign = array(
            'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
            'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
            'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
            'y', 'y', 'y', 'y', 'y', 'y',
            'd', 'd',
            'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
            'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
            'I', 'I', 'I', 'I', 'I', 'I', 'I', 'I',
            'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
            'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
            'Y', 'Y', 'Y', 'Y', 'Y', 'Y',
            'D', 'D'
        );

        $str = str_replace($hasSign, $noSign, $str);
        return $str;
    }

    /**
     * Ham check otp nhap vao co hop le khong va tra ve thong bao tuong ung
     * Tra ve TRUE neu thong tin hop le
     * @author NamDT5
     * @created on Sep 10, 2011
     * @param unknown_type $otp
     * @return
     */
    public static function checkOtp($otp)
    {
        if (!$otp) {
            return sfConfig::get('app_otp_no_data');
        } else
        {
            if (preg_match('/^([0-9]){8}+$/', $otp)) {
                return true;
            } else
            {
                return self::getOtpInvalidMsg();
            }
        }
    }

    public static function getOtpInvalidMsg($redirectBack = true, $redirectLink = null)
    {
        $msg = sfConfig::get('app_otp_code_201');
        if ($redirectBack) {
            if ($redirectLink !== null) {
                $msg .= ' <a href="' . $redirectLink . '">Quay lại</a> ';
            } else
            {
                $link = (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
                $msg .= ($link !== false) ? ' <a href="' . $link . '">Quay lại</a> ' : '';
            }
        }

        return $msg;
    }

    public static function formatCallType($type)
    {
        if ($type == "O")
            return "Gọi đi";
        if ($type == "D")
            return "Cuộc gọi chuyển hướng";
        if ($type == "M")
            return "Tin nhắn";

        return "Loại khác";
    }

    public static function formatCallTypePre($type)
    {
        if ($type == "D")
            return "Data";
        if ($type == "S")
            return "Tin nhắn";
        if ($type == "C")
            return "Gọi đi";
        if ($type == "V")
            return "Dịch vụ GTGT";
        if ($type == "R")
            return "Roaming";

        return "Loại khác";
    }

    public function checkValidTimeTraCuoc($fromDate, $toDate)
    {
        $fromTime = strtotime($fromDate);
        $toTime = strtotime($toDate);

        if ($fromTime < strtotime('-4 month')) {
            return 'Ngày bắt đầu tra cước cách thời điểm hiện tại tối đa 4 tháng.';
        }
        if ($toTime > time()) {
            return 'Ngày kết thúc phải trước ngày hiện tại.';
        }
        $duration = $toTime - $fromTime;
        if ($duration < 0) {
            return 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.';
        }
        if ($duration > 31 * 24 * 60 * 60) {
            return 'Quý khách vui lòng nhập lại khoảng thời gian tra cứu, khoảng thời gian tra cứu tối đa là 31 ngày.';
        }
    }

    public function checkValidTimeTraCuoc2($fromDate)
    {
        $fromTime = strtotime($fromDate);

        if ($fromTime < strtotime('-4 month')) {
            return 'Tháng tra cước phải cách thời điểm hiện tại tối đa 4 tháng.';
        }
    }

    public function checkValidTimeTraCuocPreMobile($fromDate, $toDate)
    {
        $fromTime = strtotime($fromDate);
        $toTime = strtotime($toDate);

        if ($fromTime < strtotime('-2 month')) {
            return 'Ngày bắt đầu tra cước cách thời điểm hiện tại tối đa 2 tháng.';
        }
        if ($toTime > time()) {
            return 'Ngày kết thúc phải trước ngày hiện tại.';
        }
        $duration = $toTime - $fromTime;
        if ($duration < 0) {
            return 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc.';
        }
        if ($duration > 5 * 24 * 60 * 60) {
            return 'Quý khách vui lòng nhập lại khoảng thời gian tra cứu, khoảng thời gian tra cứu tối đa là 5 ngày.';
        }
        return false;
    }

    /**
     * Ham loai bo tat ca cac the html
     * @author NamDT5
     * @created on May 19, 2011
     * @param string $str - Xau can loai bo tag
     * @param array $tags - Mang cac tag se strip, vi du: array('a', 'b')
     * @param boolean $stripContent
     * @return String
     */
    public static function strip_html_tags($str, $tags = array(), $stripContent = false)
    {
        if (empty($tags)) {
            $tags = array("!--...--", '!doctype', 'a', 'abbr', 'address', 'area', 'article', 'aside', 'audio', 'b', 'base', 'bb', 'bdo', 'blockquote', 'body', 'br', 'button', 'canvas', 'caption', 'cite', 'code', 'col', 'colgroup', 'command', 'datagrid', 'datalist', 'dd', 'del', 'details', 'dfn', 'div', 'dl', 'dt', 'em', 'embed', 'eventsource', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hgroup', 'hr', 'html', 'i', 'iframe', 'img', 'input', 'ins', 'kbd', 'keygen', 'label', 'legend', 'li', 'link', 'mark', 'map', 'menu', 'meta', 'meter', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option', 'output', 'p', 'param', 'pre', 'progress', 'q', 'ruby', 'rp', 'rt', 'samp', 'script', 'section', 'select', 'small', 'source', 'span', 'strong', 'style', 'sub', 'summary', 'sup', 'table', 'tbody', 'td', 'textarea', 'tfoot', 'th', 'thead', 'time', 'title', 'tr', 'ul', 'var', 'video', 'wbr');
        }

        $content = '';
        if (!is_array($tags)) {
            $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
            if (end($tags) == '') array_pop($tags);
        }
        foreach ($tags as $tag)
        {
            if ($stripContent)
                $content = '(.+</' . $tag . '(>|\s[^>]*>)|)';
            $str = preg_replace('#</?' . $tag . '(>|\s[^>]*>)' . $content . '#is', '', $str);
        }
        return $str;
    }


    public static function getOriginalBccsGW($val, $tagOpenName, $tagCloseName)
    {
        $pos1 = strpos($val, $tagOpenName); //tag open
        $pos2 = strpos($val, $tagCloseName); //tag close
        $source = substr($val, $pos1, $pos2 - $pos1 + strlen($tagCloseName));
        return json_decode(json_encode(simplexml_load_string($source)));
    }

    public static function getValueOriginalBccsGW($val, $tagOpenName, $tagCloseName)
    {
        $pos1 = strpos($val, $tagOpenName); //tag open
        $pos2 = strpos($val, $tagCloseName); //tag close
        $source = substr($val, $pos1 + strlen($tagOpenName), $pos2 - ($pos1 + strlen($tagOpenName)));
//var_dump($source); die;
        return json_decode(json_encode($source));
    }

    public static function encodeOutput($string)
    {
        return htmlentities($string, ENT_COMPAT, 'UTF-8');
    }

    public static function genRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }
}
