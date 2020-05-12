<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class DetailsResult {
	
	private $threat_name;
	private $av_name;


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