<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class MobileAppsResult {
	
	private $name;
	private $vendor;
	private $community_rate;
	private $community_reviewer;

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