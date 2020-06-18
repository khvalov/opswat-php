<?php
//https://onlinehelp.opswat.com/metaaccess/Get_groups.html
namespace OpswatPHP;

class Group extends OpswatPHPResource
{
	
    public static function all($params = null, $apiKey = null){
        $APIVER='3';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());

        list($response, $apiKey) = $requestor->request('post', $url, $params);
        
        return new ResultIterator($response,new Group\GroupResult());
    }
   
}
