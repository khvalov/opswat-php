<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class StatusChangedResult {
	
	private $monitored_devices;
	private $deleted_devices;


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
	
		if(count($value)>0) {
			foreach ($value as $v){
				$newValue[]=Util::ArrayToClass(new DeviceResult(),$v);
			}
			if(count($newValue)>0){
				$value=$newValue;
				unset($newValue);
			}
		}

		$this->{$name} = $value;
	}

}