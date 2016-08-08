<?php

/**
 * Created by JetBrains PhpStorm.
 * User: huync2
 * Date: 1/6/14
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

class VtpSoapClient extends SoapClient
{
    private $timeout;

    public function  __construct($wsdl, $options)
    {
        $connectTimeout = isset($options['connect_timeout']) ? intval($options['connect_timeout']) : 0;
        $responseTimeout = isset($options['timeout']) ? intval($options['timeout']) : 0;
        if ($connectTimeout > 0) {
            $curl = curl_init($wsdl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
//      curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
            //var_dump(curl_errno($curl));die;

            if (curl_errno($curl)) {

                if (sfConfig::get('sf_environment') == 'dev') {
                    throw new Exception('ERROR: ' . curl_error($curl), sfLogger::ERR);
                } else {
                    throw new Exception(sfConfig::get('app_message_system_error'));
                }
            } else {
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                if ($httpCode != 200) {
                    if (sfConfig::get('sf_environment') == 'dev') {
//                echo "Return code is {$httpCode} \n" .curl_error($curl); die;
                        throw new Exception('Unexpected HTTP CODE ' . $httpCode . ' for ' . $wsdl, sfLogger::ERR);
                    } else {
                        throw new Exception(sfConfig::get('app_message_system_error'));
                    }
                }
            }
            curl_close($curl);
        }

        if ($responseTimeout > 0) {
            $this->timeout = $responseTimeout;
        }

        parent::SoapClient($wsdl, $options);
    }

    public function __setTimeout($timeout)
    {
        if (!is_int($timeout) && !is_null($timeout)) {
            throw new Exception("Invalid timeout value");
        }

        $this->timeout = $timeout;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = FALSE)
    {
        if (!$this->timeout) {
            // Call via parent because we require no timeout
            $response = parent::__doRequest($request, $location, $action, $version, $one_way);
        } else {
            // Call via Curl and use the timeout
            $curl = curl_init($location);

            curl_setopt($curl, CURLOPT_VERBOSE, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    "SOAPAction: xyz", "Content-Type: text/xml"
                ));
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);


            $response = curl_exec($curl);


            if (curl_errno($curl)) {
                if (sfConfig::get('sf_environment') == 'dev') {
                    throw new Exception($location . ':' . curl_error($curl));
                } else {
                    throw new Exception('');
                }
            }

            curl_close($curl);
        }

        // Return?
        if (!$one_way) {
            return ($response);
        }
    }

}