<?php
//https://onlinehelp.opswat.com/metaaccess/1.2.1._Account.html
namespace OpswatPHP;

class Account extends OpswatPHPResource
{
    
    public static function configuration($params = null, $apiKey = null){
        
        $APIVER='3.1';

        if(!array_key_exists('sections', $params)) {
            throw new Error("Sections have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = '/configuration';

        list($response, $apiKey) = $requestor->request('post', $url, $params);

        return Util::ArrayToClass(new Account\ConfigurationResult(),$response,false);
    }



    public static function policy($params = null, $apiKey = null){
        
        $APIVER='2';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = '/account';
        list($response, $apiKey) = $requestor->request('get', $url.'/policy', $params);

        return Util::ArrayToClass(new Account\PolicyResult(),$response);
    }

    public static function all($params = null, $apiKey = null){
        $APIVER='3.1';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = '/account';

        list($response, $apiKey) = $requestor->request('get', $url, $params);

        return Util::ArrayToClass(new Account\AccountResult(),$response);
    }

   
}
