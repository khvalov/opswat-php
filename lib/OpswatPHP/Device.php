<?php
//https://onlinehelp.opswat.com/metaaccess/1.2.2._Devices.html

namespace OpswatPHP;

class Device extends OpswatPHPResource
{

    public static function details($params = null, $apiKey = null){
        $APIVER='3.3';

        $_return=false;
        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('post', $url.'/detail', $params);

        if(is_array($response) && count($response)>0) {
            foreach ($response as $v){
                $_return[]=Util::ArrayToClass(new Device\DeviceResult(),$v);
            }
        }

        return $_return;
    }

    public static function delete($params = null, $apiKey = null){
        
        $APIVER='2.2';

        if(!array_key_exists('device_id', $params)) {
            throw new Error("Device ID (device_id) have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('post', $url.'/'.$params['device_id'].'/delete', $params);

        return Util::ArrayToClass(new Device\DeleteResult(),$response);
    }

    public static function action($params = null, $apiKey = null){
        
        $APIVER='3.2';

        if(!array_key_exists('types', $params)) {
            throw new Error("Action Type have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('post', $url.'/action', $params);
        
        if(is_array($response) && count($response)>0) {
            foreach ($response as $v){
                $_return[]=Util::ArrayToClass(new Device\ActionResult(),$v);
            }
        }

        return $_return;
    }

    public static function info($params = null, $apiKey = null){
        $APIVER='3';
        $_return=false;

        if(!array_key_exists('ids', $params)) {
            throw new Error("Device IDs have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = "";
        list($response, $apiKey) = $requestor->request('post', $url.'/device_info', $params);
        
        if(is_array($response) && count($response)>0) {
            foreach ($response as $v){
                $_return[]=Util::ArrayToClass(new Info\InfoResult(),$v);
            }
        }

        return $_return;
    }

    public static function policy_check($params = null, $apiKey = null){
        $APIVER='2';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('post', $url.'/policy_check', $params);
        
        return Util::ArrayToClass(new Device\PolicyCheckResult(),$response);
    }

    public static function stats($params = null, $apiKey = null){
        $APIVER='2';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('get', $url.'/stats', $params);
        
        return Util::ArrayToClass(new Device\StatsResult(),$response);
    }

    public static function all($params = null, $apiKey = null){
        $APIVER='3.3';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());

        list($response, $apiKey) = $requestor->request('post', $url, $params);
        if(is_array($response) && count($response)>0) {
            foreach ($response as $v){
                $_return[]=Util::ArrayToClass(new Device\InfoResult(),$v);
            }
        }
        return $_return;

    }

    public static function remediation($params = null, $apiKey = null){
        
        $APIVER='3';

        if(!array_key_exists('device_id', $params)) {
            throw new Error("Device ID (device_id) have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('get', $url.'/'.$params['device_id'].'/remediation', $params);

        return Util::ArrayToClass(new Device\RemediationResult(),$response);
    }


    public static function get_reports($params = null, $apiKey = null){
        
        $APIVER='3.1';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = "";

        if(!array_key_exists('type', $params)){
            throw new Error("Type is shoud be defined for this action");
        }
        if( ($params['type']=='os_patch_summary') || ($params['type']=='device_missing_os_patch') || ($params['type']=='missing_os_patch')){
            throw new Error("This function is not implemented");
        }

        list($response, $apiKey) = $requestor->request('get', $url.'/get_reports', $params);

        return Util::ArrayToClass(new Device\GetReportsResult(),$response);
    }

    public static function get_threats($params = null, $apiKey = null){
        
        $APIVER='3';

        if(!array_key_exists('id', $params)) {
            throw new Error("Device ID (id) have to be defined for this action");
        }

        $requestor = new Requestor($apiKey,$APIVER);
        $url = "";
        list($response, $apiKey) = $requestor->request('post', $url.'/get_threats', $params);

        return Util::ArrayToClass(new Device\GetThreatsResult(),$response);
    }

    public static function status_changed($params = null, $apiKey = null){
        
        $APIVER='3';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());

        list($response, $apiKey) = $requestor->request('post', $url.'/status_changed', $params);

        return Util::ArrayToClass(new Device\StatusChangedResult(),$response);;
    }
   
}
