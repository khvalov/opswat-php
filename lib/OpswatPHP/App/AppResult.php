<?php
namespace OpswatPHP\App;

use OpswatPHP\Util;

Class AppResult {

	private $category_id;
	private $category_name;
	private $severity;
	private $product_id;
	private $name;
	private $vendor;
	private $version;
	private $number_of_devices;
	private $number_of_cves;

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