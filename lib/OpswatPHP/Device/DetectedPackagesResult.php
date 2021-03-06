<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class DetectedPackagesResult {
	
	private $total;
	private $packages;

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