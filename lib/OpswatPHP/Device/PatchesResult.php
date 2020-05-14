<?php
namespace OpswatPHP\Device;

use OpswatPHP\Util;

Class PatchesResult {
	
	private $category;
	private $titles;
	private $description;
	private $product;
	private $vendor;
	private $severity;
	private $kb_name;
	private $release_date;

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