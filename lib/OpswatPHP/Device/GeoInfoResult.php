<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class GeoInfoResult {
	
	private $country_code;
	private $city;
	private $country_name;
	private $country;
	private $region_name;
	private $region_code;


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