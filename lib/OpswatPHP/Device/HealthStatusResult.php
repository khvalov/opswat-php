<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class HealthStatusResult {
	
	private $status;
	private $issue;
	private $log;

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