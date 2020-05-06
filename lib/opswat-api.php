<?php

// Required PHP extensions
if (!function_exists('curl_init')) {
    throw new Exception('OPSWAT-PHP needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('OPSWAT-PHP needs the JSON PHP extension.');
}

// Config and Utilities
require(dirname(__FILE__) . '/OpswatPHP/OpswatPHP.php');
require(dirname(__FILE__) . '/OpswatPHP/Util.php');
require(dirname(__FILE__) . '/OpswatPHP/Error.php');
require(dirname(__FILE__) . '/OpswatPHP/OpswatObject.php');
require(dirname(__FILE__) . '/OpswatPHP/OpswatResource.php');
require(dirname(__FILE__) . '/OpswatPHP/Requestor.php');

?>
