<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class InfectionResult {
	
	private $metascan;
	private $antivirus;
	private $ip_scanning;


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
		if($name=='metascan') {
			$value=Util::ArrayToClass(new MetascanResult(),$value);
		}
		if($name=='antivirus') {
			$value=Util::ArrayToClass(new AntivirusResult(),$value);
		}
		if($name=='ip_scanning') {
			$value=Util::ArrayToClass(new IpScanningResult(),$value);
		}
		$this->{$name} = $value;
	}

}