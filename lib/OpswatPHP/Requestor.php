<?php

namespace OpswatPHP;

class Requestor
{
    /**
     * @var string
     */
    public $apiKey;

    /**
     * constructor
     *
     * @param string $apiKey
     */
    public function __construct($apiKey = null,$apiVer= null)
    {
        $this->_apiKey = $apiKey;
        $this->_apiVer = $apiVer;
    }

    /**
     * get the API url
     *
     * @param string $url
     * @return string
     */
    public static function apiUrl($url = '',$apiVer='1.0')
    {
        $apiBase = OpswatPHP::$apiBase;

        return "{$apiBase}v{$apiVer}{$url}";
    }

    /**
     * @param mixed $value
     * @return string
     */
    public static function utf8($value)
    {
        if (is_string($value) && mb_detect_encoding($value, "UTF-8", true) != "UTF-8") {
            return utf8_encode($value);
        }

        return $value;
    }

    /**
     * @param mixed $d
     * @return array|string
     */
    private static function _encodeObjects($d)
    {
        if ($d instanceof OpswatPHPResource) {
            return array("id" => self::utf8($d->id));
        } elseif ($d === true) {
            return 'true';
        } elseif ($d === false) {
            return 'false';
        } elseif (is_array($d)) {
            $res = array();
            foreach ($d as $k => $v) {
                $res[$k] = self::_encodeObjects($v);
            }

            return $res;
        } else {
            return self::utf8($d);
        }
    }

    /**
     * @param mixed $arr
     * @param null  $prefix
     * @return string
     */
    public static function encodeOLD($arr, $prefix = null)
    {
        if (!is_array($arr)) {
            return $arr;
        }

        $r = array();
        foreach ($arr as $k => $v) {
            if (is_null($v)) {
                continue;
            }

            if ($prefix && isset($k)) {
                $k = $prefix . "[" . $k . "]";
            } elseif ($prefix) {
                $k = $prefix . "[]";
            }

            if (is_array($v)) {
                $r[] = self::encode($v, $k, true);
            } else {
                $r[] = urlencode($k) . "=" . urlencode($v);
            }
        }

        return implode("&", $r);
    }

    public static function encode($arr){
        return json_encode($arr);

    }

    /**
     * @param string $method
     * @param string $url
     * @param mixed  $params
     * @return array
     * @throws \OpswatPHP\Error
     */
    public function request($method, $url, $params = null, $apiKeyRequired = true)
    {
        if (!$params) {
            $params = array();
        }
        list($httpBody, $httpStatus, $myApiKey) = $this->_requestRaw($method, $url, $params, $apiKeyRequired);
        $response = $this->_interpretResponse($httpBody, $httpStatus);

        return array($response, $myApiKey);
    }

    /**
     * @param string $method
     * @param string $url
     * @param mixed  $params
     * @return array
     * @throws \OpswatPHP\Error
     */
    private function _requestRaw($method, $url, $params, $apiKeyRequired)
    {
        $myApiKey = $this->_apiKey;

        if (!$myApiKey) {
            if (!$myApiKey = OpswatPHP::$apiKey) {
                if ($apiKeyRequired) {
                    throw new Error('No API key provided. Set your API key using "OpswatPHP::setApiKey(<API-KEY>)".');
                }
            }
        }

        $absUrl = $this->apiUrl($url,$this->_apiVer);
        $absUrl.='?access_token='.OpswatPHP::$apiKey;
        $params = self::_encodeObjects($params);

        $langVersion = phpversion();
        $uname = php_uname();
        $ua = array(
            'bindings_version' => OpswatPHP::VERSION,
            'lang'             => 'php',
            'lang_version'     => $langVersion,
            'publisher'        => 'OpswatPHP Cli',
            'uname'            => $uname
        );
        $headers = array('X-Client-User-Agent: ' . json_encode($ua),
            'User-Agent: OpswatPHP PhpClient/' . OpswatPHP::VERSION,
            'Content-Type: application/json',
            "Authorization: Bearer {$myApiKey}");
        if (OpswatPHP::$apiVersion) {
            $headers[] = 'OpswatPHP-Version: ' . OpswatPHP::$apiVersion;
        }

        list($httpBody, $httpStatus) = $this->_curlRequest($method, $absUrl, $headers, $params, $myApiKey);

        return array($httpBody, $httpStatus, $myApiKey);
    }

    /**
     * @param string $method
     * @param string $absUrl
     * @param mixed  $headers
     * @param mixed  $params
     * @param string $myApiKey
     * @return array
     * @throws \OpswatPHP\Error
     */
    private function _curlRequest($method, $absUrl, $headers, $params, $myApiKey)
    {
        $curl = curl_init();
        $method = strtolower($method);
        $curlOptions = array();

        // method
        if ($method == 'get') {
            $curlOptions[CURLOPT_HTTPGET] = 1;
            if (count($params) > 0) {
                $encoded = http_build_query($params);
                $glue=strpos($absUrl,"?") === false?"?":"&";
                $absUrl = "$absUrl".$glue."$encoded";
            }
        } elseif ($method == 'post') {
            $curlOptions[CURLOPT_POST] = 1;
            $curlOptions[CURLOPT_POSTFIELDS] = json_encode($params);
        } elseif ($method == 'delete') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
            if (count($params) > 0) {
                $encoded = self::encode($params);
                $absUrl = "{$absUrl}?{$encoded}";
            }
        } elseif ($method == 'patch' || $method == 'put') {
            $curlOptions[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
            if (count($params) > 0) {
                $curlOptions[CURLOPT_POSTFIELDS] = self::encode($params);
            }
        } else {
            throw new Error("Unrecognized method {$method}");
        }

        $absUrl = self::utf8($absUrl);



        $curlOptions[CURLOPT_URL] = $absUrl;
        $curlOptions[CURLOPT_RETURNTRANSFER] = true;
        $curlOptions[CURLOPT_HTTPHEADER] = $headers;

        if ($timeout = OpswatPHP::getConnectTimeout()) {
            $curlOptions[CURLOPT_CONNECTTIMEOUT_MS] = $timeout;
        }

        if ($timeout = OpswatPHP::getResponseTimeout()) {
            $curlOptions[CURLOPT_TIMEOUT_MS] = $timeout;
        }

        curl_setopt_array($curl, $curlOptions);
        $httpBody = curl_exec($curl);

        $errorNum = curl_errno($curl);

        if ($httpBody === false) {
            $errorNum = curl_errno($curl);
            $message = curl_error($curl);
            curl_close($curl);
            $this->handleCurlError($errorNum, $message);
        }

        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return array($httpBody, $httpStatus);
    }

    /**
     * @param string $httpBody
     * @param int    $httpStatus
     * @return mixed
     * @throws \OpswatPHP\Error
     */
    private function _interpretResponse($httpBody, $httpStatus)
    {
        try {
            $response = json_decode($httpBody, true);
        } catch (\Exception $e) {
            throw new Error("Invalid response body from API: HTTP Status: ({$httpStatus}) {$httpBody}", $httpStatus, $httpBody);
        }

        if ($httpStatus < 200 || $httpStatus >= 300) {
            $this->handleApiError($httpBody, $httpStatus, $response);
        }
        return $response;
    }

    /**
     * @param string $httpBody
     * @param int    $httpStatus
     * @param array  $response
     * @throws \OpswatPHP\Error
     */
    public function handleApiError($httpBody, $httpStatus, $response)
    {
        if (!is_array($response) || !isset($response['error'])) {
            throw new Error("Invalid response object from API: HTTP Status: ({$httpStatus}) {$httpBody})", $httpStatus, $httpBody);
        }
        throw new Error(is_array($response['error']) ? $response['error']['message'] : (!empty($response['error']) ? $response['error'] : ""), $httpStatus, $httpBody);
    }

    /**
     * @param int    $errorNum
     * @param string $message
     * @throws \OpswatPHP\Error
     */
    public function handleCurlError($errorNum, $message)
    {
        $apiBase = OpswatPHP::$apiBase;
        switch ($errorNum) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Opswat API ({$apiBase}). Please check your internet connection and try again.";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify Opswat API SSL certificate. Please make sure that your network is not intercepting certificates.  (Try going to {$apiBase} in your browser.)";
                break;
            default:
                $msg = "Unexpected error communicating with Opswat API. ";
        }

        $msg .= "\nNetwork error [errno {$errorNum}]: {$message})";
        throw new Error($msg);
    }
}
