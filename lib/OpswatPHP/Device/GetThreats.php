<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class GetThreats {
	
	private $antimalware_scan;
	private $local_antimalware_threats;


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
		if($name=='antimalware_scan') {
			$value=Util::ArrayToClass(new AntimalwareScanResult(),$value);
		}
		if($name=='local_antimalware_threats') {
			$value=Util::ArrayToClass(new LocalAntimalwareThreatsResult(),$value);
		}
		$this->{$name} = $value;
	}

}