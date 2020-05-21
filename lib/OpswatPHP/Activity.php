<?php
//https://onlinehelp.opswat.com/metaaccess/Get_Access_Activities.html
namespace OpswatPHP;

class Activity extends OpswatPHPResource
{

    public static function all($params = null, $apiKey = null){
        $APIVER='3';
        $url = '/activities';

        $requestor = new Requestor($apiKey,$APIVER);

        list($response, $apiKey) = $requestor->request('post', $url, $params);

        return new ResultIterator($response,new Activity\ActivityResult());
    }
   
}
