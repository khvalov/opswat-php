<?php
// https://onlinehelp.opswat.com/metaaccess/1.2.6._Applications.html
namespace OpswatPHP;

class App extends OpswatPHPResource
{

    public static function all($params = null, $apiKey = null){
        $APIVER='3';

        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());

        list($response, $apiKey) = $requestor->request('post', $url, $params);

        return new ResultIterator($response,new App\AppResult());
    }


    public static function details($params = null, $apiKey = null){
        
        $APIVER='3';

        if(!array_key_exists('product_id', $params) || !array_key_exists('version', $params)) {
            throw new Error("Product ID (product_id) and Version have to be defined for this action");
        }
        $requestor = new Requestor($apiKey,$APIVER);
        $url = self::classUrl(get_class());
        list($response, $apiKey) = $requestor->request('post', $url.'/details', $params);

        return Util::ArrayToClass(new App\DetailsResult(),$response);
    }

   
}
