<?php
namespace OpswatPHP\Log;

use OpswatPHP\Util;

Class LogItemResult {

	private $timestamp;
	private $event;
	private $device_id;
	private $device_name;
	private $mac_addresses;
	private $details;

	public function __construct(array $_settings=null){

	}

	public function __get($name) {
		if(!empty($this->{$name})) {
		    return $this->{$name};
		} else {
		   return null;
		}
	}

	public function __set($name, $value) {
		$this->{$name} = $value;
	}

}