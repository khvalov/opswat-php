<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class DetectedProcessesResult {
	
	private $total;
	private $processes;

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