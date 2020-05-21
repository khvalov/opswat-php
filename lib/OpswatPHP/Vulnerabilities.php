<?php
// https://onlinehelp.opswat.com/metaaccess/Get_Vulnerabilities.html
namespace OpswatPHP;

class Vulnerabilities extends OpswatPHPResource
{

    public static function all($params = null, $apiKey = null){
        $APIVER='3';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = '/cves';

        list($response, $apiKey) = $requestor->request('post', $url, $params);

        return new ResultIterator($response,new Vulnerabilities\VulnerabilitiesResult());
    }



   
}
